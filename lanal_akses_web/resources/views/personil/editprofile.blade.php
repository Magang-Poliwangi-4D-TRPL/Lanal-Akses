@extends('layout.personil.app')

@section('title-page', 'Personil | Edit Data Personil')

@section('content')

<style>
    #myTab {
        margin-bottom: 25px;
    }

    .image-container {
        position: relative;
        max-width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px; /* Menambahkan jarak antara foto dan tombol unggah */
    }

    .image-profile {
        width: 127px;
        height: 127px;
        border: 2px solid #0D21A1;
        border-radius: 100%;
        object-fit: cover;
    }

    .edit-icon {
        position: absolute;
        bottom: 0;
        right: 0;
        background-color: #0D21A1;
        color: white;
        border-radius: 50%;
        cursor: pointer;
        padding: 5px;
    }

    .cancel-icon {
        position: absolute;
        top: 0;
        right: 0;
        background-color: #ff0000;
        color: white;
        border-radius: 50%;
        cursor: pointer;
        padding: 5px;
    }

    #image-upload-dialog {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 999;
    }

    .image-upload-content {
        background-color: white;
        padding: 20px;
        border-radius: 16px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        text-align: center;
        position: relative;
        width: 400px; /* Atur lebar sesuai kebutuhan Anda */
    }

    #cancel-upload-icon {
        position: absolute;
        top: 20px;
        right: 20px;
        cursor: pointer;
    }

    .upload-box {
        margin: 20px 0;
        padding: 20px;
        border: 0px dashed #0D21A1;
        border-radius: 16px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    #image-upload-input {
        display: none;
    }

    .upload-text-box {
        width: 295px;
        height: 136px;
        border: 2px dashed #0D21A1;
        border-radius: 16px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    #upload-text {
        cursor: pointer;
    }

    .upload-button {
        margin-top: 20px;
    }

    #image-upload-label {
        background-color: #0D21A1;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        cursor: pointer;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-5 mt-4">
            <!-- Bagian Kiri -->
            <div class="bg-white p-4 col-12 text-center">
                <div class="image-container">
                    <img src="images/admin/default-profile.jpg" alt="default-profile" border="0" height="auto"
                        class="rounded-circle image-profile">
                    <div class="edit-icon" id="edit-image-icon">
                        <i class="fas fa-edit"></i>
                    </div>
                </div>
                <h2 class="mt-3 bluedark text-center jabatan">Nama Jabatan</h2>
                <h4 class="text-center nama">Nama Lengkap Personil</h4>
                <p class="text-center" style="color: grey; border-bottom: 2px solid #0D21A1;">NRP Personil</p>
            </div>
        </div>

        <div class="col-md-7 mt-4 bg-white">
            <!-- Bagian Kanan -->
            <div class="bg-white p-4">
                <h2 class="text-left" style="font-size: 36px; margin: 45px 0;">Profil Personil</h2>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="data-pribadi-tab" data-toggle="tab" href="#data-pribadi" role="tab"
                            aria-controls="data-pribadi" aria-selected="true">Ubah Data Pribadi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="ubah-password-tab" data-toggle="tab" href="#ubah-password" role="tab"
                            aria-controls="ubah-password" aria-selected="false">Ubah Password</a>
                    </li>
                </ul>

                <!-- Bagian Kiri -->
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="data-pribadi" role="tabpanel" aria-labelledby="data-pribadi-tab">
                        <form class="form-horizontal">
                            <div class="form-group row">
                                <label for="pangkat" class="col-sm-2 col-form-label">Pangkat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="pangkat" placeholder="Pangkat">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tinggi_berat" class="col-sm-2 col-form-label">Tinggi/Berat Badan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="tinggi_berat" placeholder="Tinggi/Berat Badan">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="status_perkawinan" class="col-sm-2 col-form-label">Status Perkawinan</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="status_perkawinan">
                                        <option value="M">Menikah</option>
                                        <option value="B">Belum Menikah</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="alamat_sekarang" class="col-sm-2 col-form-label">Alamat Sekarang</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="alamat_sekarang" placeholder="Alamat Sekarang">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="status_rumah" class="col-sm-2 col-form-label">Status Rumah</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="status_rumah">
                                        <option value="M">Memiliki Rumah</option>
                                        <option value="K">Kontrak</option>
                                        <option value="L">Tinggal di Mes</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10 offset-sm-2">
                                    <button type="button" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="ubah-password" role="tabpanel" aria-labelledby="ubah-password-tab">
                        <div class="form-group row">
                            <label for="password_lama" class="col-sm-2 col-form-label">Password Lama</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password_lama" placeholder="Password Lama">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-secondary" id="show-password-lama">
                                            <i class="far fa-eye text-light" id="eye-icon-lama"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for ="password_baru" class="col-sm-2 col-form-label">Password Baru</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password_baru" placeholder="Password Baru">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-secondary" id="show-password-baru">
                                            <i class="far fa-eye text-light" id="eye-icon-baru"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="konfirmasi_password" class="col-sm-2 col-form-label">Konfirmasi Password</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="password" class="form-control" id="konfirmasi_password"
                                        placeholder="Konfirmasi Password">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-secondary" id="show-password-konfirmasi">
                                            <i class="far fa-eye text-light" id="eye-icon-konfirmasi"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="button" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<div id="image-upload-dialog">
    <div class="image-upload-content">
        <div id="cancel-upload-icon">
            <i class="fas fa-times" id="cancel-upload"></i>
        </div>
        <div class="upload-box">
            <input type="file" id="image-upload-input" accept="image/*">
            <div class="upload-text-box">
                <p id="upload-text">Klik di sini untuk melakukan upload gambar</p>
            </div>
        </div>
        <div class="upload-button">
            <label for="image-upload-input" id="image-upload-label">
                <i class="fas fa-cloud-upload-alt"></i>
                Unggah Gambar
            </label>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const uploadTextBox = document.getElementById("upload-text");
        const imageUploadInput = document.getElementById("image-upload-input");
        const imageProfile = document.querySelector(".image-profile");

        // Fungsi untuk mengunggah gambar saat teks diklik
        uploadTextBox.addEventListener("click", function () {
            imageUploadInput.click();
        });

        // Mengubah gambar profil saat gambar yang dipilih dari input
        imageUploadInput.addEventListener("change", function () {
            const selectedImage = imageUploadInput.files[0];
            if (selectedImage) {
                const imageUrl = URL.createObjectURL(selectedImage);
                imageProfile.src = imageUrl;
                closeImageUploadDialog();
            }
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const editImageIcon = document.getElementById("edit-image-icon");
        const imageUploadDialog = document.getElementById("image-upload-dialog");
        const imageUploadInput = document.getElementById("image-upload-input");
        const imageProfile = document.querySelector(".image-profile");

        // membuka dialog unggah gambar
        function openImageUploadDialog() {
            imageUploadDialog.style.display = "flex";
        }

        // menutup dialog unggah gambar
        function closeImageUploadDialog() {
            imageUploadDialog.style.display = "none";
        }

        // Mengubah gambar profil saat gambar yang dipilih
        imageUploadInput.addEventListener("change", function () {
            const selectedImage = imageUploadInput.files[0];
            if (selectedImage) {
                const imageUrl = URL.createObjectURL(selectedImage);
                imageProfile.src = imageUrl;
                closeImageUploadDialog();
            }
        });

        // mengaktifkan klik ikon edit gambar
        if (editImageIcon) {
            editImageIcon.addEventListener("click", openImageUploadDialog);
        }

        // membatalkan unggah gambar
        const cancelUploadIcon = document.getElementById("cancel-upload");
        if (cancelUploadIcon) {
            cancelUploadIcon.addEventListener("click", closeImageUploadDialog);
        }
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const passwordLamaInput = document.getElementById("password_lama");
        const passwordBaruInput = document.getElementById("password_baru");
        const konfirmasiPasswordInput = document.getElementById("konfirmasi_password");

        // mengganti tampilan password menjadi terlihat
        function togglePasswordVisibility(inputElement, eyeIconElement) {
            if (inputElement.type === "password") {
                inputElement.type = "text";
                eyeIconElement.classList.remove("fa-eye");
                eyeIconElement.classList.add("fa-eye-slash");
            } else {
                inputElement.type = "password";
                eyeIconElement.classList.remove("fa-eye-slash");
                eyeIconElement.classList.add("fa-eye");
            }
        }

        // Menambahkan event listener untuk toggle password visibility
        function addTogglePasswordVisibilityEvent(inputElementId, eyeIconElementId) {
            const inputElement = document.getElementById(inputElementId);
            const eyeIconElement = document.getElementById(eyeIconElementId);

            if (inputElement && eyeIconElement) {
                eyeIconElement.addEventListener("click", function () {
                    togglePasswordVisibility(inputElement, eyeIconElement);
                });
            }
        }

        // Panggil fungsi untuk setiap kolom password
        addTogglePasswordVisibilityEvent("password_lama", "eye-icon-lama");
        addTogglePasswordVisibilityEvent("password_baru", "eye-icon-baru");
        addTogglePasswordVisibilityEvent("konfirmasi_password", "eye-icon-konfirmasi");
    });
</script>
