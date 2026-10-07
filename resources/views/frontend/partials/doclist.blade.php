@php
    $sw = app()->getLocale() == 'sw';
@endphp
<div class="fct-doclist my-2">
    @forelse($listItems as $item)
        @php
            $icon = 'bi-file-earmark-text'; $iconColor = '#5b6770';
            if ($listKind === 'info') {
                $ft  = strtolower((string) ($item->file_type ?? ''));
                $ext = $item->file_path ? strtolower(pathinfo($item->file_path, PATHINFO_EXTENSION)) : '';
                if (str_contains($ft . $ext, 'pdf')) { $icon = 'bi-file-earmark-pdf'; $iconColor = '#c0392b'; }
                elseif (str_contains($ft, 'word') || in_array($ext, ['doc','docx'])) { $icon = 'bi-file-earmark-word'; $iconColor = '#2b579a'; }
                elseif (str_contains($ft, 'excel') || in_array($ext, ['xls','xlsx','csv'])) { $icon = 'bi-file-earmark-excel'; $iconColor = '#1e7145'; }
            }
            $metaParts = [];
            if ($listKind === 'info') {
                $d = $item->decision_date ?? $item->registration_date;
                if ($d) { $metaParts[] = ($item->decision_date ? ($sw ? 'Ilioamuliwa: ' : 'Decided: ') : ($sw ? 'Iliyosajiliwa: ' : 'Registered: ')) . \Illuminate\Support\Carbon::parse($d)->format('d M Y'); }
                if ($item->case_type) { $metaParts[] = ucfirst($item->case_type); }
                if ($item->status) { $metaParts[] = $item->status; }
                if ($item->issue) { $metaParts[] = ($sw ? 'Suala: ' : 'Issue: ') . $item->issue; }
            } else {
                if ($item->year) { $metaParts[] = $item->year; }
                if ($item->download_count !== null) { $metaParts[] = $item->download_count . ' ' . ($sw ? 'vipakuzi' : 'downloads'); }
            }
        @endphp
        <div class="fct-doclist-row">
            <i class="bi {{ $icon }} fct-doclist-icon" style="color: {{ $iconColor }};" aria-hidden="true"></i>
            <div class="fct-doclist-main">
                <a href="{{ $listKind === 'publication' ? route('publications.show', $item->slug) : route('info-library.show', $item->slug) }}" class="fct-doclist-title">{{ $item->getField('title') }}</a>
                @if($item->case_number ?? false)
                    <div class="fct-doclist-meta">{{ $item->case_number }}</div>
                @endif
                @if(count($metaParts))
                    <div class="fct-doclist-meta">{{ implode(' &bull; ', $metaParts) }}</div>
                @endif
                @if($listKind === 'info' && $item->parties)
                    <div class="fct-doclist-meta">{{ $item->parties }}</div>
                @endif
            </div>
            <div class="fct-doclist-actions">
                <a href="{{ $listKind === 'publication' ? route('publications.show', $item->slug) : route('info-library.show', $item->slug) }}" class="btn btn-sm btn-outline-primary">{{ $sw ? 'Ona' : 'View' }}</a>
                @if($item->file_path)
                    <a href="{{ $listKind === 'publication' ? route('publications.download', $item->slug) : route('info-library.download', $item->slug) }}" class="btn btn-sm btn-primary">{{ $sw ? 'Pakua' : 'Download' }}</a>
                @endif
            </div>
        </div>
    @empty
        <div class="alert alert-info my-3">{{ $sw ? 'Hakuna rekodi zilizopatikana.' : 'No records found.' }}</div>
    @endforelse
</div>
@if(method_exists($listItems, 'hasPages') && $listItems->hasPages())
    <nav class="d-flex justify-content-center mt-4" aria-label="Pagination">{{ $listItems->links() }}</nav>
@endif
