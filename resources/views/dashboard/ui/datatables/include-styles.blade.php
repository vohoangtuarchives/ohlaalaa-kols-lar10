<link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{{ asset("assets/libs/sweetalert2/sweetalert2.min.css") }}" rel="stylesheet" type="text/css" />
<style>
    .dt-id{
        width: 30px!important;
    }
    .dt-action{
        width: 50px!important;
    }
    .dt-code{
        width: 50px!important;
    }
    @if(isset($options['hideSearch']) && $options['hideSearch'] === true)
    #datatables-html_filter{
        display: none;
    }
    @endif

    @if(isset($options['hideChangeLength']) && $options['hideChangeLength'] === true)
    #datatables-html_length{
        display: none;
    }
    @endif
</style>