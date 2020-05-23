<div class="row">
    <div class='col-md-12'>
        <h5>{{$customer->name}} ({{$customer->kode}})</h5>
    </div>
    <div class='col-md-6'><i class='fa fa-envelope'></i> : 
        {{ $customer->email ?? "--" }}
    </div>
    <div class='col-md-6'><i class='fa fa-phone'></i> : 
        {{ $customer->telp ?? "--" }}
    </div>
    <div class='col-md-6'><i class='fa fa-user'></i> : 
        {{ $customer->pic ?? "--" }}
    </div>
    <div class='col-md-6'><i class='fa fa-home'></i> : 
        {{ $customer->alamat ?? "--" }}
    </div>
</div>