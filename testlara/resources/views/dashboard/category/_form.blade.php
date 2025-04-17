
@csrf

<label for="">Title</label>
<input type="text" class="form-control" name="title" value="{{old('title',$category->title)}}">

<label for="">Slug</label>
<input type="text" class="form-control" name="slug" value="{{old('slug',$category->slug)}}">

<button class="btn btn-primary mt-3" type="submit">Send</button>