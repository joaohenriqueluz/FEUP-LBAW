<!-- Reported User -->
<div class="user-tab-menu active-tab menu-content user-{{$report->reported->id}}">
    <div class="user-report report card mb-4 post-container">
        <div class="card-body">
            {{-- <a href="{{ route('admin_user', $report->reported->id) }}"> --}}
            {{-- {{dd( $report->reported)}} --}}
            <a href="{{ route('admin.profile', $report->reported->id) }}">
                <img height="35" width="35" class="profile-pic-small" src="{{ asset($report->reported->photo) }}"
                    alt="Profile Image">
                <span>@<span>{{ $report->reported->username }} </a>
            <p class="card-text mt-2" style="white-space: pre-line"><i
                    class="fas fa-exclamation-triangle mr-2"></i>{{ $report->report->reason }}</p>
        </div>
        <div class="card-footer row text-muted mx-0">
            <div class="col-md-6 align-self-center">
                <div class="card-footer-buttons row align-content-center justify-content-start">
                    <a href="" class="admin-delete" data-type='user' data-object='{{$report->reported->id}}'><i
                            class="fas fa-ban"></i>Ban User</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row align-self-center justify-content-end">
                    @if($report->report->reporter != null)
                    <a href="{{ route('admin.profile', $report->report->reporter->id)}}">
                        <img height="35" width="35" class="profile-pic-small"
                            src="{{ asset($report->report->reporter->photo) }}" alt="Profile Image">
                    </a>
                    @endif
                    <span class="px-1 align-self-center">{{ date('F d, Y', strtotime( $report->report->time_stamp ))}}
                        by</span>
                    @if($report->report->reporter == null)
                    <a>@unknown</a>
                    @else
                    <a class="align-self-center" href="{{ route('admin.profile', $report->report->reporter->id) }}">
                        <span>@<span>{{ $report->report->reporter->username }}
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>