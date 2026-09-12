<?php

namespace App\Http\Controllers;

use App\Models\BookIssue;

class LibraryController extends Controller
{
    public function issued()
    {
        $issues = BookIssue::with(['book', 'libraryMember.student', 'libraryMember.staff'])
            ->where('status', 'issued')->latest('issue_date')->paginate(20);
        return view('library.issued', ['issues' => $issues]);
    }
}
