
<img src="{!! Auth::getUser()->avatar ?? Avatar::create(Auth::getUser()->email)->toBase64() !!}"
     alt="kendozone_avatar">
