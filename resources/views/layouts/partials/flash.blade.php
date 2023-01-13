@if (session()->has('success'))
    toastr["success"]("{{ session()->get('success') }}", "Success");
@endif

@if (session()->has('error'))
    toastr["error"]("{{ session()->get('error') }}", "Error");
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        toastr["error"]("{{ $error }}", "Error");
    @endforeach
@endif