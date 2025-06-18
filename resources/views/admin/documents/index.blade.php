@extends('layouts.admin')

@section('content')
    <style>
        .dt-buttons { display: none; }
        .carousel-item { text-align: center; }
        .file-icon-large { font-size: 6rem; color: #888; }
        .thumbnail-container { margin-top: 1rem; }
        .thumbnail-container img,
        .thumbnail-container i { max-height: 100px; }
    </style>

    <div class="card">
        <div class="card-header">Document Manager</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable datatable-Documents">
                    <thead>
                        <tr><th colspan="7" class="text-center">
                            <div class="search-form">
                                <form method="GET" action="{{ route('admin.document.manager') }}">
                                    <div class="row">
                                        @can('all_file_filter')
                                            <div class="col-md-3">
                                                <select name="student_id" class="form-control">
                                                    <option value="">All Students</option>
                                                    @foreach (\App\Models\User::all() as $s)
                                                        <option value="{{ $s->id }}" {{ request('student_id') == $s->id ? 'selected':'' }}>
                                                            {{ $s->full_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endcan
                                        <div class="col-md-3">
                                            <select name="course_id" class="form-control">
                                                <option value="">All Courses</option>
                                                @foreach (\App\Models\Course::all() as $c)
                                                    <option value="{{ $c->id }}" {{ request('course_id') == $c->id ? 'selected':'' }}>
                                                        {{ $c->course_manager->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select name="document_id" class="form-control">
                                                <option value="">All Documents</option>
                                                @foreach (\App\Models\UploadsManager::all() as $u)
                                                    <option value="{{ $u->id }}" {{ request('document_id') == $u->id ? 'selected':'' }}>
                                                        {{ $u->file_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @can('all_file_filter')
                                            <div class="col-md-3">
                                                <select name="institution_id" class="form-control">
                                                    <option value="">All Institutions</option>
                                                    @foreach (\App\Models\Institution::all() as $i)
                                                        <option value="{{ $i->id }}" {{ request('institution_id') == $i->id ? 'selected':'' }}>
                                                            {{ $i->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endcan
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col">
                                            <button class="btn btn-primary">Search</button>
                                            <button name="download" value="1" class="btn btn-success">Download as ZIP</button>
                                            <a href="{{ route('admin.document.manager') }}" class="btn btn-secondary">Reset</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </th></tr>
                        <tr>
                            <th width="10"></th>
                            <th>{{ trans('cruds.institution.fields.id') }}</th>
                            <th>Student Name</th>
                            <th>Document Name</th>
                            <th>Course Name</th>
                            <th>Institution Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $previewableFiles = []; @endphp
                        @foreach ($documents as $document)
                            @php
                                $fileUrl = Storage::url($document->file_path);
                                $ext = strtolower(pathinfo($fileUrl, PATHINFO_EXTENSION));
                                $previewExts = ['pdf', 'jpg','jpeg','png','gif','docx','xlsx','pptx'];
                                $isPreviewable = in_array($ext, $previewExts);
                                if ($isPreviewable) {
                                    $previewableFiles[] = ['url'=>$fileUrl, 'ext'=>$ext, 'name'=>$document->document->file_name . '.v' . $document->version];
                                }
                            @endphp
                            <tr>
                                <td></td>
                                <td>{{ $document->id }}</td>
                                <td>{{ $document->student->full_name }}</td>
                                <td>{{ $document->document->file_name . '.v' . $document->version }}</td>
                                <td>{{ $document->course->course_manager->name }}</td>
                                <td>{{ $document->institution->name }}</td>
                                <td>
                                    <a class="btn btn-xs btn-info" href="{{ $fileUrl }}" target="_blank">Download</a>
                                    @if ($isPreviewable)
                                        <button class="btn btn-xs btn-warning preview-btn"
                                            data-url="{{ $fileUrl }}"
                                            data-ext="{{ $ext }}">
                                            Preview
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if(count($previewableFiles) > 1)
                    <button id="previewAllBtn" class="btn btn-primary mt-2">Preview All</button>
                @endif
            </div>
        </div>
    </div>

    <!-- Preview Modal -->
    <div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">File Previews</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div id="previewCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner" id="carouselInner"></div>
                        <a class="carousel-control-prev" href="#previewCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#previewCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>
                        <div class="thumbnail-container d-flex justify-content-center flex-wrap" id="carouselThumbnails"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
    $(function(){
        $('.datatable-Documents').DataTable();

        function getPreviewContent(file){
            const {url, ext, name} = file;
            const imgExt = ['jpg','jpeg','png','gif'];
            const officeExt = ['docx','xlsx','pptx'];
            if (ext === 'pdf') {
                return `<iframe src="${url}" width="100%" height="600"></iframe>`;
            } else if (imgExt.includes(ext)) {
                return `<img src="${url}" class="img-fluid" alt="${name}">`;
            } else if (officeExt.includes(ext)) {
                const encoded = encodeURIComponent(location.origin + url);
                return `<iframe src="https://view.officeapps.live.com/op/embed.aspx?src=${encoded}" width="100%" height="600"></iframe>`;
            } else {
                return `<i class="file-icon-large far fa-file"></i><p>${name}</p>`;
            }
        }

        function renderCarousel(files, startIndex=0){
            const inner = $('#carouselInner').empty();
            const thumbs = $('#carouselThumbnails').empty();
            files.forEach((file, idx) => {
                const item = $('<div>').addClass('carousel-item').toggleClass('active', idx===startIndex)
                    .html(getPreviewContent(file))
                    .attr('data-idx', idx);
                inner.append(item);
                // thumbnail
                const thumb = $('<a href="#" class="m-1">').attr('data-target','#previewCarousel').attr('data-slide-to', idx)
                    .html(file.ext==='pdf' ? '<i class="file-icon-large far fa-file-pdf"></i>' 
                           : ['jpg','jpeg','png','gif'].includes(file.ext) ? `<img src="${file.url}" width="80">`
                           : `<i class="file-icon-large far fa-file-alt"></i>`);
                thumbs.append(thumb);
            });
        }

        $('.preview-btn').click(function(){
            const file = [{ url: $(this).data('url'), ext: $(this).data('ext'), name: '' }];
            renderCarousel(file,0);
            $('#previewModal').modal('show');
        });

        $('#previewAllBtn').click(function(){
            const files = @json($previewableFiles);
            renderCarousel(files, 0);
            $('#previewModal').modal('show');
        });

        $('#previewModal').on('hidden.bs.modal', function(){
            $('#carouselInner, #carouselThumbnails').empty();
        });
    });
    </script>
@endsection
