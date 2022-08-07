<script id="doctorDashboardTemplate" type="text/x-jsrender">
<tr>
    <td>
        <div class="symbol symbol-45px me-2">
            <img src="{{:image}}" class="symbol symbol-circle object-cover align-self-center" alt="">
        </div>
    </td>
    <td>
        <a href="{{:route}}" class="text-primary-800 mb-1 fs-6">{{:name}}</a>
        <span class="text-muted fw-bold d-block">{{:email}}</span>
    </td>
    <td class="text-start">
        <span class="badge badge-light-success">{{:patientId}}</span>
    </td>
    <td class="mb-1 fs-6 text-muted fw-bold text-center">
        <div class="badge badge-light-info">
            <div class="mb-2">{{:from_time}} {{:from_time_type}} - {{:to_time}} {{:to_time_type}}</div>
            <div class="">{{:date}}</div>
        </div>
    </td>
</tr>






</script>
