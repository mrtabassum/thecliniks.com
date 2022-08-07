<script id="adminDashboardTemplate" type="text/x-jsrender">

<tr>
    <td>
        <div class="symbol symbol-45px me-2">
            <img src="{{:image}}" class="symbol symbol-circle object-cover align-self-center" alt="">
        </div>
    </td>
    <td>
        <a href="{{:route}}" class="fw-bolder text-primary mb-1 fs-6">{{:name}}</a>
        <span class="text-muted fw-bold d-block">{{:email}}</span>
    </td>
    <td class="text-start">
        <span class="badge badge-light-success">{{:patientId}}</span>
    </td>
        <td class="text-center">
        <span class="badge badge-light-danger">{{:appointment_count}}</span>
    </td>
    <td class="text-center text-muted fw-bold">
        <span class="badge badge-light-info">
            {{:registered}}
        </span>
    </td>
</tr>





</script>
