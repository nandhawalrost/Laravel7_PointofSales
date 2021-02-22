<html>
<head><title></title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

<h1>Produk</h1>

<form class="w-75 p-3" action="/produk/create" method="POST">

{{csrf_field()}}

    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Produk</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" name="nama_produk" placeholder="Nama Produk">
        </div>
    </div>

    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Harga</label>
        <div class="col-sm-10">
        <input type="number" class="form-control" name="harga" placeholder="Harga">
        </div>
    </div>
  
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
  </div>
</form>

<table class="table table-hover col-10">
    <tr>
        <th>ID</th>
        <th>NAMA PRODUK</th>
        <th>HARGA</th>
        <th>AKSI</th>
    </tr>

    @foreach($produk as $produk)
    <tr>
        <td>{{$produk->id}}</td>
        <td>{{$produk->nama_produk}}</td>
        <td>{{$produk->harga}}</td>
        <td>
        <a href="/produk/{{$produk->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
        <a href="/produk/{{$produk->id}}/delete" class="btn btn-danger btn-sm">Delete</a>
        </td>
    </tr>
    @endforeach
</table>
</body>
</html>