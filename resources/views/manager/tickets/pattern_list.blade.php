<option value="">Нет</option>
@foreach($templates as $template)
<option value="{{  $template->id }}">{{  $template->title }}</option>
@endforeach