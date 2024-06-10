<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::all();
        return response($comments, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Comment::validate($request->all());
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $comment = Comment::create($request->all());

        return response($comment, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], Response::HTTP_NOT_FOUND);
        }

        return response($comment, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], Response::HTTP_NOT_FOUND);
        }

        $validator = Comment::validate($request->all());
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        if ($request->user_id != $comment->user_id) {
            return response()->json(['message' => 'User not found'], Response::HTTP_BAD_REQUEST);
        }

        $comment->update([
            'comment' => $request->comment
        ]);

        return response($comment, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], Response::HTTP_NOT_FOUND);
        }

        $comment->delete();

        return response()->json(['message' => 'Comment deleted sucessfully'], Response::HTTP_OK);
    }
}
