@public
	@if ($user->photourl && Storage::exists($user->photourl))
		<img width="{{ $width }}" src="{{ asset('storage/' . $user->photourl) }}">
	@endif
@endpublic

@dropbox
	@if ($user->photourl && Storage::exists($user->photourl))
		<img width="{{ $width }}" src="{{ Storage::getAdapter()->getTemporaryLink($user->photourl) }}">
	@endif
@enddropbox
