@extends('tampilan.app')

@section('content')
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Akun</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Edit<span class="lnr lnr-arrow-right"></span></a>
                        <a href="category.html">Akun</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="blog_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8" style="margin-top:30px; ">
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
                    <h3>Profil</h3>
                    <form class="row contact_form" action="{{ route('updateUser') }}" method="POST"
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
                                            {{ $user->id }} </div>
                                        <input type="hidden"
                                            style="height: 40px; width: 450px; border: 1px solid rgb(225, 225, 225); line-height: 40px; padding-left:10px; color:grey"
                                            value="{{ $user->id }}" name="id">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Nama</label>
                                    </td>
                                    <td>
                                        <input type="text"
                                            style="height: 40px; width: 450px; border: 1px solid rgb(225, 225, 225); line-height: 40px; padding-left:10px; color:grey"
                                            name="name">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Email </label>
                                    </td>
                                    <td>
                                        <div
                                            style="height: 40px; width: 450px; border: 1px solid rgb(225, 225, 225); line-height: 40px; padding-left:10px; color:grey">
                                            {{ $user->email }} </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Nomor telepon</label>
                                    </td>
                                    <td>
                                        <input type="text"
                                            style="height: 40px; width: 450px; border: 1px solid rgb(225, 225, 225); line-height: 40px; padding-left:10px; color:grey"
                                            name="no_telepon">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Password </label>
                                    </td>
                                    <td>
                                        <input type="password"
                                            style="height: 40px; width: 450px; border: 1px solid rgb(225, 225, 225); line-height: 40px; padding-left:10px; color:grey"
                                            name="password">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="submit"
                            style="color: white;display:flex; justify-content:center; align-items: center; text-decoration: none; font-size:16px; margin:10px 0px 0px 34%; width: 100px; height: 40px; background-color: orange">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
