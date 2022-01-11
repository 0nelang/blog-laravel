@extends('layouts.main') {{-- @if ($post->user->image)
    <img
      src="{{ asset('storage/' . $post->user->image) }}"
alt=""
style="height: 60%; width: 100%"
/>
@else
<img src="/css/img/defaultProfile.png" class="rounded-circle" style="width: 50px" />
@endif --}} @section('main')

<div class="row mt-4">
    <div class="col-3 mx-auto judul">
        <div class="image-placeholder" style="
            height: 400px;
            background-color: #dedede;
            display: flex;
            justify-content: center;
            align-items: center;
          ">
            @if ($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" alt="" style="max-width: 100%; max-height: 100%" />
            @else
            <img src="https://source.unsplash.com/400x600?{{ $post->category->category }}"
                style="height: 400px; overflow: hidden" />
            @endif
        </div>

        <h6 class="mt-3">
            by
            <a href="/author/{{ $post->user->name }}">{{ $post->user->name }}</a> in
            <a href="/category/{{ $post->category->slug }}">{{ $post->category->category }}</a>
        </h6>

        @if (in_array(auth()->user()->id,
        $post->likes->pluck('user_id')->toArray()))
        <form action="/unlike/{{ $post->slug }}" method="post" class="unfollow">
            @csrf
            <button type="submit" class="ms-2 btn btn-link outline-0 shadow-none border-0">
                <i class="fas fa-heart"></i>
            </button>
            <p class="d-inline">{{ $post->likes->count() }}</p>
        </form>
        @else
        <form action="/like/{{ $post->slug }}" method="post" class="follow">
            @csrf
            <input type="hidden" value="{{ $post->id }}" name="likeable_id" />
            <input type="hidden" value="{{ auth()->user()->id }}" name="user_id" />
            <input type="hidden" value="App\Models\Post" name="likeable_type" />
            <button type="submit" class="ms-2 btn btn-link outline-0 shadow-none border-0">
                <i class="far fa-heart"></i>
            </button>
            <p class="d-inline">{{ $post->likes->count() }}</p>
        </form>
        @endif @if ($post->tags) @foreach ($post->tags as $tag)
        <h6>{{ $tag->tag->tag }}</h6>
        @endforeach @endif
    </div>

    <div class="col-7 mx-auto">
        <h2>{{ $post ->title }}</h2>

        <article class="border-bottom border-2 mb-3">
            <p>{!! $post->body !!}</p>
        </article>

        <div class="comment-section">
            <h3>Write a comment</h3>
            <form action="/comment/{{ $post->slug }}" method="POST" class="mb-3 d-flex">
                @csrf
                <input type="hidden" value="{{ $post->id }}" name="commentable_id" />
                <input type="hidden" value="App\Models\Post" name="commentable_type" />
                <input type="hidden" value="{{ auth()->user()->id }}" name="user_id" />
                <textarea id="comment-input" name="text" cols="100%" rows="1" onkeyup="checkInput()"></textarea>
                <button id="comment-input-button" type="submit" class="ms-2 btn btn-primary disabled">comment</button>
            </form>
            @foreach ($post->comments as $index => $item )
                <div class="comment-{{ $index }}">
                    <div class="main-comment d-flex">
                        <div class="profile pt-2">
                            @if ($item->user->img)
                                <div id="profilePicture" style="background-image: url({{ $item->user->img }})"></div>
                            @else
                            <div id="profilePicture" style="background-image: url(/css/img/defaultProfile.png)"></div>
                                @endif
                        </div>

                        <div class="lol ps-2" style="">
                            <a href="/author/{{ $item->user->name }}"
                                style="margin-left: 10px; font-size: 12px">{{ $item->user->name }}</a>
                            <p style="margin: 0; margin-left: 10px">{{ $item->text }}</p>

                            <div class="comment-action d-flex">
                                @if (in_array(auth()->user()->id,
                                $item->likes->pluck('user_id')->toArray()))

                                <form action="/unlikecomment/{{ $item->id }}" method="post" class="unfollow">
                                    @csrf
                                    <button type="submit" class="ms-2 btn btn-link outline-0 shadow-none border-0"
                                        style="margin: 0px; padding: 0px">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                    <p class="d-inline">{{ $item->likes->count() }}</p>
                                </form>

                                @else

                                <form action="/likecomment/{{ $item->id }}" method="post" class="follow">
                                    @csrf
                                    <input type="hidden" value="{{ $item->id }}" name="likeable_id" />
                                    <input type="hidden" value="{{ auth()->user()->id }}" name="user_id" />
                                    <input type="hidden" value="App\Models\Comment" name="likeable_type" />
                                    <button type="submit" class="ms-2 btn btn-link outline-0 shadow-none border-0"
                                        style="margin: 0; padding: 0">
                                        <i class="far fa-heart"></i>
                                    </button>
                                    <p class="d-inline">{{ $item->likes->count() }}</p>
                                </form>

                                @endif

                                <p class="ps-2 reply" onclick="reply({{ $index }})" style="cursor: pointer">
                                    reply
                                </p>
                            </div>

                            <div class="reply-comment-{{ $index }}" style="display: none">
                                <form action="/reply/{{ $item->id }}" method="POST" class="mb-3 d-flex">
                                    @csrf
                                    <input type="hidden" value="{{ $item->id }}" name="commentable_id" />
                                    <input type="hidden" value="App\Models\Comment" name="commentable_type" />
                                    <input type="hidden" value="{{ auth()->user()->id }}" name="user_id" />
                                    <textarea name="text" cols="100%" rows="1" class="reply-input-{{ $index }}" onkeyup="checkReply({{ $index }})"></textarea>
                                    <button type="submit" class="ms-2 btn btn-primary reply-input-button-{{ $index }} disabled">reply</button>
                                    <a class="ms-2 btn btn-secondary" onclick="hideReply({{ $index }})">
                                    close</a>
                                </form>
                            </div>
                            
                        </div>
                        
                        

                        <div class="main-comment-option dropdown ms-auto mt-3" style="display: none">
                            <a class="btn" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                        
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                @if ($item->user_id == auth()->user()->id)

                                    <li><a class="dropdown-item" href="/comment/delete/{{ $item->id }}"><i class="fas fa-trash-alt"></i> delete</a></li>
                                    <li><a class="dropdown-item" onclick="edit({{ $index }})"><i class="fas fa-pencil-alt"></i> edit</a></li>
                                
                                @else
                                    <li><a class="dropdown-item" href="#">report</a></li>
                                @endif
                            
                            </ul>
                        </div>
                        
                    </div>
                    <div class="reply-comment ms-5">
                        @if ($item->comments->count() != 0)
                            <p class="text-primary" onclick="viewReply({{ $index }})" style="cursor: pointer">
                                view {{ $item->comments->count() }} reply
                            </p>
                        @endif
                            
                        @foreach ($item->comments as $replyIndex => $reply)
                        
                            <div class="hilzam d-flex">

                                <div class="reply-section-{{ $index }} reply-{{ $index }}-{{ $replyIndex }}" style="display: none">
            
                                    <div class="comment d-flex mb-3">
                                        <div class="profile pt-2">
                                            @if ($reply->user->img)
                                            <div id="profilePicture" style="background-image: url({{ $reply->user->img }})"></div>
                                            @else
                                            <div id="profilePicture" style="background-image: url(/css/img/defaultProfile.png)">
                                            </div>
                                            @endif
                                        </div>
                                        <div class="lol ps-2">
                                            <a href="/author/{{ $reply->user->name }}"
                                                style="margin-left: 10px; font-size: 12px">{{ $reply->user->name }}</a>
                                            <p style="margin: 0; margin-left: 10px">{{ $reply->text }}</p>
            
                                            <div class="comment-action d-flex">
                                                @if (in_array(auth()->user()->id,
                                                $reply->likes->pluck('user_id')->toArray()))
            
                                                <form action="/unlikecomment/{{ $reply->id }}" method="post" class="unfollow">
                                                    @csrf
                                                    <button type="submit" class="ms-2 btn btn-link outline-0 shadow-none border-0"
                                                        style="margin: 0px; padding: 0px">
                                                        <i class="fas fa-heart"></i>
                                                    </button>
                                                    <p class="d-inline">{{ $reply->likes->count() }}</p>
                                                </form>
            
                                                @else
            
                                                <form action="/likecomment/{{ $reply->id }}" method="post" class="follow">
                                                    @csrf
                                                    <input type="hidden" value="{{ $reply->id }}" name="likeable_id" />
                                                    <input type="hidden" value="{{ auth()->user()->id }}" name="user_id" />
                                                    <input type="hidden" value="App\Models\Comment" name="likeable_type" />
                                                    <button type="submit" class="ms-2 btn btn-link outline-0 shadow-none border-0"
                                                        style="margin: 0; padding: 0">
                                                        <i class="far fa-heart"></i>
                                                    </button>
                                                    <p class="d-inline">{{ $reply->likes->count() }}</p>
                                                </form>
            
                                                @endif
                                            </div>
                                        </div>
                                    </div>
            
                                </div>
                                <div class="comment-option dropdown ms-auto mt-3" style="display: none">
                                    <a class="btn" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        @if ($reply->user_id == auth()->user()->id)

                                        <li><a class="dropdown-item" href="/comment/delete/{{ $reply->id }}"><i class="fas fa-trash-alt"></i> delete</a></li>
                                        <li><a class="dropdown-item" onclick="editReply({{ $index }},{{ $replyIndex }})"><i class="fas fa-pencil-alt"></i> edit</a></li>
                                    
                                    @else
                                        <li><a class="dropdown-item" href="#">report</a></li>
                                    @endif
                                    </ul>
                                </div>
                            </div>

                            <div class="reply-edit-{{ $index }}-{{ $replyIndex }}" style="display: none">
                                <form action="/comment/edit/{{ $reply->id }}" method="POST" class="mb-3 reply-comment-{{ $index }}-{{ $replyIndex }} d-flex">
                                    @method('put')
                                    @csrf
                                    <textarea name="text" cols="100%" rows="1" class="edit-input-{{ $index }}-{{ $replyIndex }}" onkeyup="checkEditReply({{ $index }},{{ $replyIndex }})"></textarea>
                                    <button type="submit" class=" ms-2 btn btn-primary edit-input-button-{{ $index }}-{{ $replyIndex }} disabled">edit</button>
                                    <a class=" ms-2 btn btn-secondary" onclick="hideEditReply({{ $index }},{{ $replyIndex }})">close</a>
                                </form> 
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="comment-edit-{{ $index }}" style="display: none">
                    <form action="/comment/edit/{{ $item->id }}" method="POST" class="mb-3 reply-comment-{{ $index }} d-flex">
                        @method('put')
                        @csrf
                        <textarea name="text" cols="100%" rows="1" class="edit-input-{{ $index }}" onkeyup="checkEdit({{ $index }})"></textarea>
                        <button type="submit" class=" ms-2 btn btn-primary edit-input-button-{{ $index }} disabled">edit</button>
                        <a class=" ms-2 btn btn-secondary" onclick="hideEdit({{ $index }})">close</a>
                    </form> 
                </div>
            @endforeach
        </div>

        <script>
            // $(document).ready(function() {
            //     $(".judul form").hide();
            //     if ({{ in_array(auth()->user()->id, $post->likes->pluck('user_id')->toArray()) }}) {
            //         $(".judul form.unfollow").show();
            //     } else {
            //         $(".judul form.follow").show();
            //     }
            // })

            function checkEditReply(index, replyIndex) {
                value = $('.edit-input-' + index + '-' + replyIndex).val();
                if (value.replace(/\s/g, '').length) {
                
                    $(".edit-input-button-" + index + '-' + replyIndex).removeClass("disabled")

                }else{
                    $(".edit-input-button-" + index + '-' + replyIndex).addClass("disabled")
                }
            }

            function hideEditReply(index, replyIndex) {
                $(".reply-" + index + "-" + replyIndex).show();
                $(".reply-edit-" + index + "-" + replyIndex).hide();
            }

            function editReply(index, replyIndex) {
                $(".reply-" + index + "-" + replyIndex).hide();
                $(".reply-edit-" + index + "-" + replyIndex).show();
                
            }

            function hideEdit(key) {
                $(".comment-" + key).show();
                $(".comment-edit-" + key).hide();
            }

            function edit(key) {
                $(".comment-" + key).hide();
                $(".comment-edit-" + key).show();
            }

            function checkEdit(key) {
                value = $('.edit-input-' + key).val();
                if (value.replace(/\s/g, '').length) {
                
                    $(".edit-input-button-" + key).removeClass("disabled")

                }else{
                    $(".edit-input-button-" + key).addClass("disabled")
                }
            }

            function checkReply(key) {
                value = $('.reply-input-' + key).val();
                if (value.replace(/\s/g, '').length) {
                
                $(".reply-input-button-" + key).removeClass("disabled")

                }else{
                    $(".reply-input-button-" + key).addClass("disabled")
                }
            }
            
            function checkInput() {
                value = $('#comment-input').val();
                if (value.replace(/\s/g, '').length) {
                
                $("#comment-input-button").removeClass("disabled")

                }else{
                    $("#comment-input-button").addClass("disabled")
                }
            }

            $("div.hilzam").hover(function () {
                $(this).children(".comment-option").toggle();
            });

            $(".main-comment").hover(function () {
                $(this).children(".main-comment-option").toggle();
            });

            function reply(index) {
                $(".reply-comment-" + index).show();
            }
            
            function hideReply(index) {
                $(".reply-comment-" + index).hide();
            }

            function viewReply(index) {
                $("div.reply-section-" + index).toggle();
            }
        </script>
        @endsection
    </div>
</div>