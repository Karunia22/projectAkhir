@extends('tampilan.app')

@section('content')
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Profil</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="category.html">Profil</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="blog_area">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-warning alert-dismissible fade show fade-out" role="alert"
                    style="font-size: 15px;">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show fade-out" role="alert"
                    style="font-size: 15px;">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-8" style="margin-top:30px; ">
                    <h3>Profil</h3>
                    <form class="row contact_form" action="{{ route('editProfil') }}" method="POST"
                        novalidate="novalidate">
                        @csrf
                        @method('PUT')
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <label>ID User: </label>
                                    </td>
                                    <td>
                                        <div
                                            style="height: 40px; width: 450px; border: 1px solid rgb(225, 225, 225); line-height: 40px; padding-left:10px; color:grey">
                                            {{ $profil->id_user }}</div>
                                        <input type="hidden"
                                            style="height: 40px; width: 450px; border: 1px solid rgb(225, 225, 225); line-height: 40px; padding-left:10px; color:grey"
                                            value="{{ $profil->id_user }}" name="id_user">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Kota: </label>
                                    </td>
                                    <td>
                                        <input
                                            style="height: 40px; width: 450px; border: 1px solid rgb(225, 225, 225); line-height: 40px; padding-left:10px; color:grey"
                                            value="{{ $profil->kota }}" name="kota">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Alamat: </label>
                                    </td>
                                    <td>
                                        <input
                                            style="height: 40px; width: 450px; border: 1px solid rgb(225, 225, 225); line-height: 40px; padding-left:10px; color:grey"
                                            value="{{ $profil->alamat }}" name="alamat">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Kode Pos</label>
                                    </td>
                                    <td>
                                        <input
                                            style="height: 40px; width: 450px; border: 1px solid rgb(225, 225, 225); line-height: 40px; padding-left:10px; color:grey"
                                            value="{{ $profil->kode_pos }} " name="kode_pos">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Nomor Telepon </label>
                                    </td>
                                    <td>
                                        <input
                                            style="height: 40px; width: 450px; border: 1px solid rgb(225, 225, 225); line-height: 40px; padding-left:10px; color:grey"
                                            value="{{ $profil->no_telepon }}" name="no_telepon">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="submit"
                            style="color: white;display:flex; justify-content:center; align-items: center; text-decoration: none; font-size:16px; margin:10px 0px 0px 34%; width: 100px; height: 40px; background-color: orange">Edit
                            Profil</button>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget author_widget">
                            <img class="author_img rounded-circle" src="img/blog/author.png" alt="">
                            <h4>{{ $profil->user->name }}</h4>
                            <p>{{ $profil->user->email }}</p>
                            <div class="social_icon">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-github"></i></a>
                                <a href="#"><i class="fa fa-behance"></i></a>
                            </div>
                        </aside>
                        <ul>
                            <li><a href="{{ route('editUser') }}"
                                    style="color: white;display:flex; justify-content:center; align-items: center; text-decoration: none; font-size:16px; margin:10px 0px 0px 34%; width: 100px; height: 40px; background-color: orange">Ubah</a>
                            </li>
                            <li><a href="{{ route('logout') }}"
                                    style="color: white;display:flex; justify-content:center; align-items: center; text-decoration: none; font-size:16px; margin:10px 0px 0px 34%; width: 100px; height: 40px; background-color: orange">Keluar</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
