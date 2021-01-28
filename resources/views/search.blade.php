@extends('layouts.master')

@section('content')

    <div class="search">
        <search></search>
    </div>


@endsection

<script>
    import Search from "../js/components/Search";
    export default {
        components: {Search}
    }
</script>
