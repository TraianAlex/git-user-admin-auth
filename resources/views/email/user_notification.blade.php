<h2>Thank you for creating a Quote {{ $name }}</h2>
<p>Please register here: <a href="{{ route('mail_callback', ['author_name' => $name]) }}">Link</a></p>