<div class="widget-content">
    <ul class="category-list ">
       
<li class="current">  <a href="blog-details.html"><i class="fab fa fa-envelope "></i> Dashboard </a></li>


<li><a href="{{ route('user.profile') }}"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a></li>
<li><a href="{{ route('user.schedule.request') }}"><i class="fa fa-credit-card" aria-hidden="true"></i>Schedule Request <span class="badge badge-info">(  )</span></a></li>
<li><a href="{{ route('live.chat') }}"><i class="fa fa-indent" aria-hidden="true"></i> Live Chat  </a></li>
<li><a href="{{ route('user.change.password') }}"><i class="fa fa-key" aria-hidden="true"></i> Security </a></li>
<li><a href="{{ route('user.logout') }}"><i class="fa fa-chevron-circle-up" aria-hidden="true"></i> Logout </a></li>
    </ul>
</div>


<table id="example" class="table table-striped table-bordered table-hover text-center">
    <thead style="background-color: #1F1717; color: white;">
        <tr>
          <th>#</th>
            <th>Assessment Code</th>
            <th>Date of Visit</th>
            <th>Service Provider Name</th>
            <th>Follow-up Visit Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
      @php
      
  @endphp
      @php
      $counter = 1;
      $filteredAssessments = $assessmentRecords->sortByDesc('created_at');
  @endphp

        @forelse($filteredAssessments as $assessment)
            <tr>
              <td>{{ $counter++ }}</td>
                <td>{{ $assessment->assessment_code }}</td>
                <td>{{ $assessment->date_of_visit }}</td>
                <td>
                    <a href="#">
                        {{ $assessment->service_provider_name }}
                    </a>
                </td>
                <td>{{ $assessment->follow_up_visit_date }}</td>
                <td>
                    <a href="{{ route('view-individual-assessment', ['id' => $assessment->id]) }}"
                        class="btn btn-primary rounded-pill">
                        View Details
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">No assessments available.</td>
            </tr>
        @endforelse
    </tbody>
</table>