<!-- FAVICON -->
@foreach($logo_addresses as $logo)
<link rel="shortcut icon" type="image/x-icon" href="{{asset($logo->favicon)}}" />
@endforeach
<!-- BOOTSTRAP CSS -->
<link id="style" href="{{asset('/')}}admin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

<!-- STYLE CSS -->
<link href="{{asset('/')}}admin/assets/css/style.css" rel="stylesheet" />
<link href="{{asset('/')}}admin/assets/css/skin-modes.css" rel="stylesheet" />

<!--- FONT-ICONS CSS -->
<link href="{{asset('/')}}admin/assets/plugins/icons/icons.css" rel="stylesheet" />

<!-- INTERNAL Switcher css -->
<link href="{{asset('/')}}admin/assets/switcher/css/switcher.css" rel="stylesheet">
<link href="{{asset('/')}}admin/assets/switcher/demo.css" rel="stylesheet">

<!-- Custom css -->
<link href="{{asset('/')}}admin/assets/css/custom-css.css" rel="stylesheet">

{{--font--}}
<link rel="stylesheet" href="{{asset('/')}}admin/assets/Roboto/Roboto-Black.ttf">
<link rel="stylesheet" href="{{asset('/')}}admin/assets/Roboto/Roboto-Blod.ttf">
<link rel="stylesheet" href="{{asset('/')}}admin/assets/Roboto/Roboto-Light.ttf">
<link rel="stylesheet" href="{{asset('/')}}admin/assets/Roboto/Roboto-Medium.ttf">
<link rel="stylesheet" href="{{asset('/')}}admin/assets/Roboto/Roboto-Regular.ttf">
<link rel="stylesheet" href="{{asset('/')}}admin/assets/Roboto/Roboto-Thin.ttf">
