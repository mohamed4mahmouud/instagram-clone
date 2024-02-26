<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create new post</title>
</head>
<body>
    <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="caption">Caption</label>
        <input type="text" name="caption" id="caption">
        <label for="tags">Tags</label>
        <input type="text" name="tags[]" id="tags">
        <label for="files">Select files:</label>
        <input type="file" id="files" name="files[]" multiple><br><br>

        <input type="submit">
    </form>
</body>
</html>