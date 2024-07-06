<div class="container h-100 mt-5">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-10 col-md-8 col-lg-6">
            <h3>Update Vendor</h3>
            <form action="{{ route('vendors.update', $vendor->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Name</label>
                    <input type="text" class="form-control" id="name" name="vendor_name" value="{{ $vendor->vendor_name }}" required>
                    <label for="title">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $vendor->phone }}" required>
                    <label for="title">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $vendor->email }}" required>
                </div>
                <button type="submit" class="btn mt-3 btn-primary">Update Customer</button>
            </form>
        </div>
    </div>
</div>