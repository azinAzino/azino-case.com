<style>
    textarea {
        width: 100%;
        height: 80px;
        display: inline-block;
        margin-bottom: 20px;
    }
</style>
<form method="post" action="/admin/tickets/update/{{ $ticket->id }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <textarea id="text" name="text" required>{{ $ticket->text }}</textarea>
    <input class="btn btn-success" id="submit" name="submit" type="submit" value="Submit">
</form>