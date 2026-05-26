<x-mail::message>
# New Contact Form Submission

You have received a new contact request from the website.

**Name:** {{ $data['name'] }}  
**Email:** {{ $data['email'] }}  
**Phone:** {{ $data['phone'] ?? 'N/A' }}  
**Service Interested In:** {{ ucfirst($data['service'] ?? 'N/A') }}  

**Message:**  
{{ $data['message'] }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
