<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Appointment;

class Cart
{
    private const SESSION_KEY = 'cart_items';

    public static function addItem(string $type, int $itemId, int $quantity = 1): array
    {
        $items = self::getItems();

        $key = $type . '_' . $itemId;

        if (isset($items[$key])) {
            $items[$key]['quantity'] += $quantity;
        } else {
            if ($type === 'book') {
                $book = Book::findOrFail($itemId);
                $items[$key] = [
                    'id' => $key,
                    'type' => 'book',
                    'item_id' => $itemId,
                    'title' => $book->title,
                    'price' => (float) $book->price,
                    'quantity' => $quantity,
                    'currency' => $book->currency,
                    'digital_file' => $book->digital_file,
                    'is_digital' => $book->isDigital(),
                    'cover_image' => $book->cover_image,
                ];
            } elseif ($type === 'appointment') {
                $appointment = Appointment::findOrFail($itemId);
                $items[$key] = [
                    'id' => $key,
                    'type' => 'appointment',
                    'item_id' => $itemId,
                    'title' => $appointment->title,
                    'price' => 0,
                    'quantity' => 1,
                    'currency' => 'USD',
                    'digital_file' => null,
                    'is_digital' => false,
                    'appointment_date' => $appointment->appointment_date->format('M d, Y'),
                    'appointment_time' => date('h:i A', strtotime($appointment->appointment_time)),
                ];
            }
        }

        session([self::SESSION_KEY => $items]);
        return $items;
    }

    public static function removeItem(string $key): array
    {
        $items = self::getItems();
        unset($items[$key]);
        session([self::SESSION_KEY => $items]);
        return $items;
    }

    public static function updateQuantity(string $key, int $quantity): array
    {
        $items = self::getItems();
        if (isset($items[$key])) {
            if ($quantity <= 0) {
                return self::removeItem($key);
            }
            $items[$key]['quantity'] = $quantity;
        }
        session([self::SESSION_KEY => $items]);
        return $items;
    }

    public static function getItems(): array
    {
        return session(self::SESSION_KEY, []);
    }

    public static function count(): int
    {
        $count = 0;
        foreach (self::getItems() as $item) {
            $count += $item['quantity'];
        }
        return $count;
    }

    public static function subtotal(): float
    {
        $total = 0;
        foreach (self::getItems() as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    public static function hasDigitalItems(): bool
    {
        foreach (self::getItems() as $item) {
            if (!empty($item['is_digital'])) {
                return true;
            }
        }
        return false;
    }

    public static function hasPhysicalItems(): bool
    {
        foreach (self::getItems() as $item) {
            if (empty($item['is_digital'])) {
                return true;
            }
        }
        return false;
    }

    public static function clear(): void
    {
        session([self::SESSION_KEY => []]);
    }

    public static function isEmpty(): bool
    {
        return empty(self::getItems());
    }
}
