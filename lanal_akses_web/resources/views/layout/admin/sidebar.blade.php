<div id="sidebar-collapse" class="sidebar fixed-top top-0 bottom-0 bg-greenmain  p-4 " style="height: 100%">
    <div id="sidebar-icon" class="d-flex justify-content-end mb-4">
        <iconify-icon class="text-white" id="icon-menu" icon="material-symbols:menu" width="36"></iconify-icon>
        <iconify-icon class="text-white" id="icon-close" icon="material-symbols:close" width="36"></iconify-icon>
    </div>
    <a href="{{ url('/') }}" id="sidebar-brand" class="text-large text-white text-uppercase mx-3"><img src="https://i.ibb.co/MR438ww/logo-no-bg.png" alt="logo-no-bg" border="0" width="30rem" height="auto" class="mr-2"><span id="sidebar-title">Lanal Akses</span> </a>

    <ul id="sidebar-menu" class="my-5 p-0">
        <a class="p-3 sidebar-item text-uppercase text-white rounded {{ (request()->is('admin')) ? 'active-sidebar-item' : '' }}" href="{{  url('admin/') }}">
            <iconify-icon class="mr-3" icon="ic:{{ (request()->is('admin')) ? 'home' : 'outline-home' }}" href="{{  url('#') }}" width="24"></iconify-icon>
            <span class="sidebar-text">Dashboard</span>
        </a>
        <a class="p-3 sidebar-item text-uppercase text-white rounded {{ (request()->is('admin/pns')) ? 'active-sidebar-item' : '' }}" href="{{  url('/admin/pns') }}">
            <iconify-icon class="mr-3" icon="material-symbols:{{ (request()->is('admin/pns')) ? 'group' : 'group-outline' }}" width="24"></iconify-icon>
            <span class="sidebar-text">Data PNS</span>   
        </a>
        <a class="p-3 sidebar-item text-uppercase text-white rounded {{ (request()->is('admin/personil/*')) ? 'active-sidebar-item' : '' }}" href="{{  url('/admin/personil/1') }}">
            <iconify-icon class="mr-3" icon="material-symbols:{{ (request()->is('admin/personil/*')) ? 'group' : 'group-outline' }}" width="24"></iconify-icon>
            <span class="sidebar-text">Data Personil</span>
        </a>
        <a class="p-3 sidebar-item text-uppercase text-white rounded {{ (request()->is('admin/absensi')) ? 'active-sidebar-item' : '' }}" href="{{  url('/admin/absensi') }}">
            <iconify-icon class="mr-3" icon="mdi:{{ (request()->is('admin/absensi')) ? 'clock' : 'clock-outline' }}" width="24"></iconify-icon>
            <span class="sidebar-text">Data Absensi</span>   
        </a>
        <a class="p-3 sidebar-item text-uppercase text-white rounded {{ (request()->is('admin/tambah')) ? 'active-sidebar-item' : '' }}" href="{{  url('/admin/tambah-user') }}">
            <iconify-icon class="mr-3" icon="ic:{{ (request()->is('admin/tambah')) ? 'baseline-person-add' : 'baseline-person-add-alt' }}" width="24"></iconify-icon>
            <span class="sidebar-text">Tambah User</span>    
        </a>
        
    </ul>
    
    <button id="logout-button" class="btn btn-outline-light mt-4">Logout <iconify-icon class="ml-2" icon="ion:exit-outline" width="24"></iconify-icon></button>

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
        $(".sidebar-item").css({
            "margin": "1rem 1rem 1rem 0",
        });
        $("#sidebar-collapse").addClass("p-4");
        $("#sidebar-collapse").removeClass("p-2");
    });
</script>