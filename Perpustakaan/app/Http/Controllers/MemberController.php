<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\Cache\Store;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    // index
    public function index() {
        $members = User::where('isAdmin', 0)->get();

        return view('member.index', [
            "title" => "Member",
            "members" => $members
        ]);
    }

    // show detail data
    public function detail($id) {
        $member = User::where('id', $id)->first();

        return view('member.detail', [
            "title" => "Member Detail",
            "member" => $member
        ]);
    }

    // show edit form
    public function showEditForm($id) {
        $member = User::findOrFail($id);

        return view('member.edit', [
            "title" => "Member Edit Form",
            "member" => $member
        ]);
    }

    // update data
    public function update(Request $request, $id) {
        $member = User::findOrFail($id);
        $validateData = $request->validate([
            'name' => 'required',
            'TL' => 'required',
            'Alamat' => 'required',
            'JK' => 'required',
            'NIS',
        ]);
        
        // ddd($validateData);
        $member->update($validateData);

        return redirect()->route('member.index')->with('status', 'Data anggota berhasil diedit!');
    }

    // delete data
    public function destroy($id) {
        $member = User::findOrFail($id);
        $member->delete();

        return redirect()->route('member.index')->with('status', 'Data anggota berhasil dihapus!');
    }
}