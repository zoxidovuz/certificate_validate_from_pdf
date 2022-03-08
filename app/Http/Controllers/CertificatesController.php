<?php

namespace App\Http\Controllers;

use App\Http\Filters\CertificateFilter;
use App\Models\Certificate;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificatesController extends Controller
{
    /**
     * This is function will return certificate list by paginate. There are 25 items in per page.
     *
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $certificates = Certificate::orderBy('id', 'desc')->paginate(25);
        return view('certificates.index', compact('certificates'));
    }

    public function create()
    {
        return view('certificates.create');
    }

    public function store(Request $request)
    {
        // Validate all data by rule
        $data = $request->validate([
            'vat' => 'required',
            'name_society' => 'required',
            'type' => 'required',
            'date_certificate' => 'required',
            'file' => 'required|file|mimes:pdf|max:4096'
        ]);

        // Save file to disk

        if ($request->hasFile('file') && $request->file('file')) {
            $file_name = md5($request->file('file')->getClientOriginalName()) . time() . "." . $request->file('file')->getClientOriginalExtension();
            $request->file('file')->storeAs('public/certificates', $file_name);
        }

        $data['file'] = $file_name ?? null;

        // Save all data to db and redirect to certificate list

        Certificate::create($data);

        return redirect()->route('certificate.index');
    }

    public function show(Certificate $certificate)
    {
        // Here you can see all data of certificate. Certificate card
    }

    public function edit(Certificate $certificate)
    {
        // Only can be update name and date. Pdf file can't change
        return view('certificates.edit', compact('certificate'));
    }

    public function update(Request $request, Certificate $certificate)
    {
        // Validate all data by rule
        $data = $request->validate([
            'vat' => 'required',
            'name_society' => 'required',
            'type' => 'required',
            'date_certificate' => 'sometimes',
            'file' => 'sometimes|file|mimes:pdf|max:4096'
        ]);

        // Save file to disk

        if ($request->hasFile('file') && $request->file('file')) {

            // It will check file for available in disk before update
            if ($certificate->getAttribute('file') && Storage::disk('public')->exists('certificates/' . $certificate->getAttribute('file'))) {
                Storage::disk('public')->delete('certificates/' . $certificate->getAttribute('file'));
            }

            $file_name = md5($request->file('file')->getClientOriginalName()) . time() . "." . $request->file('file')->getClientOriginalExtension();
            $request->file('file')->storeAs('public/certificates', $file_name);
        }

        $data['file'] = $file_name ?? null;

        $certificate->update($data);

        return redirect()->route('certificate.index');
    }

    public function destroy(Certificate $certificate)
    {
        if ($certificate->getAttribute('file') && Storage::disk('public')->exists('certificates/' . $certificate->getAttribute('file'))) {
            Storage::disk('public')->delete('certificates/' . $certificate->getAttribute('file'));
        }

        $certificate->delete();

        return redirect()->route('certificate.index');
    }

    /**
     * It will be on front;
     *
     * @return Application|Factory|View
     */
    public function list(CertificateFilter $certificateFilter)
    {
        // For frontend section
        $certifications = Certificate::orderBy('id', 'desc')
            ->filter($certificateFilter)->paginate(25);

        return view('certificates.list', compact('certifications'));
    }

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function downloadCertificate(Certificate $certificate)
    {
        if ($certificate->getAttribute('file') && Storage::disk('public')->exists('certificates/' . $certificate->getAttribute('file'))) {
            return response()->download(Storage::disk('public')
                ->path('certificates/' . $certificate->getAttribute('file')), $certificate->getAttribute('file'),
                ["Content-Type: application/pdf"]);
        }

        abort(404);
    }
}
