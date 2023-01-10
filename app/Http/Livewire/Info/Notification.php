<?php

namespace App\Http\Livewire\Info;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Notification extends Component
{
    public function index(){
		return view('notifikasi');
	}

	public function sukses(){
		Session::flash('sukses','Ini notifikasi SUKSES');
		return redirect('pesan');
	}

	public function peringatan(){
		Session::flash('peringatan','Ini notifikasi PERINGATAN');
		return redirect('pesan');
	}

	public function gagal(){
		Session::flash('gagal','Ini notifikasi GAGAL');
		return redirect('pesan');
	}
    public function render()
    {
        return view('livewire.info.notification');
    }
}
