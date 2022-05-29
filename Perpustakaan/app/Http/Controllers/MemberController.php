<?php

namespace App\Http\Controllers;
use App\Models\Member;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    // index
    public function index() {
        $members = Member::all();

        return view('member.index', [
            "title" => "Member",
            "members" => $members
        ]);
    }

    // show input form 
    public function showInputForm() {
        return view('member.create', [
            "title" => "Member Input Form "
        ]);
    }

    // store input data
    public function store(Request $request) {
        $validateData = $request->validate([
            'image' => 'required | image | mimes:jpeg,png,jpg | max:2048',
            'nama' => 'required',
            'nis' => 'required | max:6',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'nomor_hp' => 'required| max:12'
        ]);

        if($request->file('image')) {
                $validateData['image'] = $request->file('image')->store('member-image');
        }
        Member::create($validateData);

        return redirect()->route('member.index')->with('status', 'Data anggota berhasil ditambah!');
    }

    // show detail data
    public function detail($id) {
        $member = Member::where('id', $id)->first();

        return view('member.detail', [
            "title" => "Member Detail",
            "member" => $member
        ]);
    }

    // show edit form
    public function showEditForm($id) {
        $member = Member::findOrFail($id);

        return view('member.edit', [
            "title" => "Member Edit Form",
            "member" => $member
        ]);
    }

    // update data
    public function update(Request $request, $id) {
        $member = Member::findOrFail($id);
        $validateData = $request->validate([
            'image' => 'required | image | mimes:jpeg,png,jpg | max:2048',
            'nama' => 'required',
            'nis' => 'required | max:6',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'nomor_hp' => 'required| max:12'
        ]);
        
        if($request->file('image')) {
            if($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validateData['image'] = $request->file('image')->store('member-image');
        }
        $member->update($validateData);

        return redirect()->route('member.index')->with('status', 'Data anggota berhasil diedit!');
    }

    // delete data
    public function destroy($id) {
        $member = Member::findOrFail($id);
        if($member->image) {
            Storage::delete($member->image);
        }
        $member->delete();

        return redirect()->route('member.index')->with('status', 'Data anggota berhasil dihapus!');
    }
}