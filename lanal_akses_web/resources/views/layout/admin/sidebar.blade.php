<style>
/* Style dasar untuk sidebar */
.sidebar {
    position: fixed;
    top: 0;
    bottom: 0;
    width: 250px;
    background-color: #2c3e50;
    padding: 20px;
    overflow-y: auto; /* Scroll otomatis */
    scrollbar-width: thin; /* Untuk Firefox */
    scrollbar-color: #888 #2c3e50; /* Warna untuk scroll di Firefox */
}

/* Custom scrollbar untuk Webkit-based browsers (Chrome, Safari) */
.sidebar::-webkit-scrollbar {
    width: 8px;
}

.sidebar::-webkit-scrollbar-thumb {
    background-color: #888;
    border-radius: 10px;
}

.sidebar::-webkit-scrollbar-thumb:hover {
    background-color: #555;
}

/* Sidebar item style */
.sidebar-item {
    display: block;
    color: #fff;
    padding: 10px 15px;
    text-decoration: none;
    transition: background 0.3s ease;
}

.sidebar-item:hover {
    background-color: #1abc9c; /* Efek hover */
}

/* Dropdown style */
.dropdown-menu {
    background-color: #34495e; /* Warna dropdown agar sesuai dengan sidebar */
    padding: 0;
    border: none;
    box-shadow: none; /* Hilangkan shadow default */
    display: none; /* Sembunyikan dropdown secara default */
    position: static; /* Pastikan dropdown tidak keluar dari flow */
}

/* Tampilkan dropdown saat hover */
.sidebar-item.dropdown-icon:hover + .dropdown-menu {
    display: block;
}

.dropdown-item {
    color: #fff;
    padding: 10px 20px;
    text-decoration: none;
    display: block;
    transition: background 0.3s ease;
}

.dropdown-item:hover {
    background-color: #1abc9c; /* Warna saat hover untuk dropdown item */
}

/* Tambahan untuk active item */
.active-sidebar-item {
    background-color: #1abc9c;
}

/* Dropdown arrow style */
.sidebar-item.dropdown-icon::after {
    content: '\25BC'; /* Tanda panah ke bawah */
    float: right;
    margin-left: 10px;
}

.sidebar-item.dropdown-icon:hover::after {
    content: '\25B2'; /* Tanda panah ke atas saat hover */
}

</style>
<div id="sidebar-collapse" class="sidebar fixed-top top-0 bottom-0 bg-greenmain  p-4 " style="height: 100%">
    <div id="sidebar-icon" class="d-flex justify-content-end mb-4">
        <iconify-icon class="text-white" id="icon-menu" icon="material-symbols:menu" width="36"></iconify-icon>
        <iconify-icon class="text-white" id="icon-close" icon="material-symbols:close" width="36"></iconify-icon>
    </div>
    <a href="{{ url('/admin') }}" id="sidebar-brand" class="text-large text-white text-uppercase mx-3"><img src="{{  URL::asset('images/admin/logo-no-bg.png') }}" alt="logo-no-bg" border="0" width="30rem" height="auto" class="mr-2"><span id="sidebar-title">Lanal Akses</span> </a>

    <ul id="sidebar-menu" class="my-5 p-0">
        <a class="p-3 sidebar-item text-uppercase text-white rounded {{ (request()->is('admin')) ? 'active-sidebar-item' : '' }}" href="{{  url('admin/') }}">
            <iconify-icon class="mr-3" icon="ic:{{ (request()->is('admin')) ? 'home' : 'outline-home' }}" href="{{  url('#') }}" width="24"></iconify-icon>
            <span class="sidebar-text">Dashboard</span>
        </a>
        <a class="p-3 sidebar-item text-uppercase text-white rounded {{ (request()->is('admin/pegawai/*')) ? 'active-sidebar-item' : '' }}" href="{{  url('/admin/pegawai/1') }}">
            <iconify-icon class="mr-3" icon="material-symbols:{{ (request()->is('admin/pegawai/*')) ? 'group' : 'group-outline' }}" width="24"></iconify-icon>
            <span class="sidebar-text">Data PNS</span>   
        </a>
        <a class="p-3 sidebar-item text-uppercase text-white rounded {{ (request()->is('admin/personil/*')) ? 'active-sidebar-item' : '' }}" href="{{  url('/admin/personil/1') }}">
            <iconify-icon class="mr-3" icon="material-symbols:{{ (request()->is('admin/personil/*')) ? 'group' : 'group-outline' }}" width="24"></iconify-icon>
            <span class="sidebar-text">Data Personel</span>
        </a>
        <a class="p-3 sidebar-item text-uppercase text-white rounded {{ (request()->is('admin/absensi/*')) ? 'active-sidebar-item' : '' }}" href="{{  url('/admin/absensi/index') }}">
            <iconify-icon class="mr-3" icon="mdi:{{ (request()->is('admin/absensi/*')) ? 'clock' : 'clock-outline' }}" width="24"></iconify-icon>
            <span class="sidebar-text">Data Absensi</span>   
        </a>

        @if(Auth::check() && Auth::user()->hasRole('admin'))
            <a class="p-3 sidebar-item text-uppercase text-white rounded {{ request()->is('admin/pengajuan-cuti*') ? 'active-sidebar-item' : '' }}" 
            href="{{ url('admin/pengajuan-cuti') }}">
                <iconify-icon class="mr-3" 
                            icon="mdi:{{ request()->is('admin/pengajuan-cuti*') ? 'file-document' : 'file-document-outline' }}" 
                            width="24">
                </iconify-icon>
                <span class="sidebar-text">Data Surat Pengajuan Cuti</span>   
            </a>
        @elseif(Auth::check() && Auth::user()->hasRole('pasmin|kaakun|paspotmar|pasintel|kasatkom|pasprogar|danposal'))
        
                <a class="p-3 sidebar-item text-uppercase text-white rounded {{ (request()->is('admin/satker/pengajuan-cuti/*')) ? 'active-sidebar-item' : '' }}" href="{{  url('/admin/satker/pengajuan-cuti') }}">
                    <iconify-icon class="mr-3" icon="mdi:{{ (request()->is('admin/satker/pengajuan-cuti/*')) ? 'file-document' : 'file-document-outline' }}" width="24"></iconify-icon>
                    <span class="sidebar-text">Data Surat Pengajuan Cuti</span>   
                </a>

        @elseif(Auth::check() && Auth::user()->hasRole('palaksa'))
        
                <a class="p-3 sidebar-item text-uppercase text-white rounded {{ (request()->is('admin/palaksa/pengajuan-cuti/*')) ? 'active-sidebar-item' : '' }}" href="{{  url('/admin/palaksa/pengajuan-cuti') }}">
                    <iconify-icon class="mr-3" icon="mdi:{{ (request()->is('admin/palaksa/pengajuan-cuti/*')) ? 'file-document' : 'file-document-outline' }}" width="24"></iconify-icon>
                    <span class="sidebar-text">Data Surat Pengajuan Cuti</span>   
                </a>

        @elseif(Auth::check() && Auth::user()->hasRole('paset'))
        
                <a class="p-3 sidebar-item text-uppercase text-white rounded {{ (request()->is('admin/sekretaris/pengajuan-cuti/*')) ? 'active-sidebar-item' : '' }}" href="{{  url('/admin/sekretaris/pengajuan-cuti') }}">
                    <iconify-icon class="mr-3" icon="mdi:{{ (request()->is('admin/sekretaris/pengajuan-cuti/*')) ? 'file-document' : 'file-document-outline' }}" width="24"></iconify-icon>
                    <span class="sidebar-text">Data Surat Pengajuan Cuti</span>   
                </a>

        @elseif(Auth::check() && Auth::user()->hasRole('komandan'))
        
                <a class="p-3 sidebar-item text-uppercase text-white rounded {{ (request()->is('admin/komandan/pengajuan-cuti/*')) ? 'active-sidebar-item' : '' }}" href="{{  url('/admin/komandan/pengajuan-cuti') }}">
                    <iconify-icon class="mr-3" icon="mdi:{{ (request()->is('admin/komandan/pengajuan-cuti/*')) ? 'file-document' : 'file-document-outline' }}" width="24"></iconify-icon>
                    <span class="sidebar-text">Data Surat Pengajuan Cuti</span>   
                </a>

        @endif

        <div class="dropdown show">
            <a class="p-3 sidebar-item text-uppercase text-white rounded dropdown-icon" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="sidebar-text">Data Akun</span> 
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="{{ route('admin.akun-admin.index', ['page' => 1]) }}">Data Akun Admin</a>
                <a class="dropdown-item" href="{{ route('admin.akun-personil.index', ['page' => 1]) }}">Data Akun Personel</a>
                <a class="dropdown-item" href="{{ route('admin.akun-pegawai.index', ['page' => 1]) }}">Data Akun Pegawai</a>
                <a class="dropdown-item" href="{{ route('admin.role.index') }}">Kelola Role</a>
                <a class="dropdown-item" href="{{ route('admin.permission.index') }}">Kelola Permission</a>
            </div>
        </div>
        
        
    </ul>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button id="logout-button" type="submit" class="btn btn-outline-light ml-2 py-2 px-4 rounded-lg">Logout <iconify-icon class="align-middle" icon="ion:exit-outline" width="18"></iconify-icon></button>
    </form>

</div>

<script>

    $("#icon-close").click(function(){
        document.getElementById("icon-menu").style.display = "inline";
        document.getElementById("icon-close").style.display = "none";
        document.getElementById("sidebar-collapse").style.width = "5rem";
        document.getElementById("sidebar-title").style.display = "none";
        $(".sidebar-text").hide();
        $(".content-margin").removeClass("content-wrap");
        $("#sidebar-icon").removeClass("justify-content-end");
        $("#sidebar-icon").addClass("justify-content-center");
        $("#logout-button").text("");
        $("#logout-button").html('<iconify-icon icon="ion:exit-outline" width="24"></iconify-icon>');
        $("#logout-button").removeClass("px-4");
        $("#sidebar-collapse").removeClass("p-4");
        $("#sidebar-collapse").addClass("p-2");
        $(".sidebar-item").css({
            "margin": "0",
            "padding": "0"
        });
    });

    $("#icon-menu").click(function(){
        document.getElementById("icon-close").style.display = "inline";
        document.getElementById("icon-menu").style.display = "none";
        document.getElementById("sidebar-collapse").style.width = "25rem";
        document.getElementById("sidebar-title").style.display = "inline";
        $(".sidebar-text").show();
        $(".content-margin").addClass("content-wrap");
        $("#sidebar-icon").addClass("justify-content-end");
        $("#sidebar-icon").removeClass("justify-content-center");
        $("#logout-button").html('Logout <iconify-icon class="ml-2" icon="ion:exit-outline" width="24"></iconify-icon>');
        $('#logout-button').addClass('px-4');
        $(".sidebar-item").css({
            "margin": "1rem 1rem 1rem 0",
        });
        $("#sidebar-collapse").addClass("p-4");
        $("#sidebar-collapse").removeClass("p-2");
    });
</script>