<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    /**
    * @OA\GET(
    *   path="/api/post",
    *   summary="Get all posts",
    *   tags={"Post"},
    *   @OA\Response(
    *       response=200,
    *       description="Ok",
    *   ),
    * )
    */
    public function index()
    {
        $posts = Post::all();

        return response()->json($posts, Response::HTTP_OK);
    }

    /**
    * @OA\POST(
    *   path="/api/post",
    *   summary="Create a new post",
    *   tags={"Post"},
    *   @OA\RequestBody(
    *       @OA\MediaType(
    *           mediaType="application/json",
    *           @OA\Schema(
    *               @OA\Property(
    *                   property="user_id",
    *                   type="int",
    *                   example="156"
    *                 ),
    *               @OA\Property(
    *                   property="category_id",
    *                   type="int",
    *                   example="112"
    *                 ),
    *               @OA\Property(
    *                   property="image",
    *                   type="string",
    *                   example="https://via.placeholder.com/640x480.png/00ee11?text=asperiores"
    *                ),
    *               @OA\Property(
    *                   property="title",
    *                   type="string",
    *                   example="Quisquam error debitis molestias adipisci nostrum"
    *                ),
    *               @OA\Property(
    *                   property="slug",
    *                   type="string",
    *                   example="quisquam-error-debitis-molestias-adipisci-nostrum2"
    *                ),
    *               @OA\Property(
    *                   property="text",
    *                   type="string",
    *                   example="Quidem et exercitationem repellendus eos maxime earum eligendi ipsam. Ab voluptatum ex ut suscipit. Veritatis neque et eius. Et accusamus hic minima quia laboriosam repellat. Deleniti corporis quis explicabo quasi reprehenderit porro. Optio vitae nostrum quia voluptatum rerum et facilis. Accusamus sit inventore aspernatur. Esse numquam sit id voluptatem et ullam itaque. Delectus ipsam excepturi neque sit impedit iusto porro. Qui doloribus ut pariatur quia aut. Ut illo et vel nihil repellendus sit dolore officia. Accusantium nobis ducimus numquam similique pariatur laboriosam. Ut sint iusto saepe. Animi nam ab odit omnis doloribus"
    *                ),
    *             )
    *         )
    *     ),
    *   @OA\Response(
    *       response=201,
    *       description="Post created",
    *   ),
    *   @OA\Response(
    *       response=400,
    *       description="Bad request"
    *   )
    * )
    */
    public function store(Request $request)
    {
        $validator = Post::validate($request->all());
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $post = Post::create($request->all());

        return response()->json($post, Response::HTTP_CREATED);
    }

    /**
    * @OA\GET(
    *   path="/api/post/{id}",
    *   summary="Get a specific post",
    *   tags={"Post"},
    *   @OA\Parameter(
    *       name="id",
    *       in="path",
    *       required=true,
    *       @OA\Schema(
    *           type="integer"
    *       )
    *   ),
    *   @OA\Response(
    *       response=200,
    *       description="Ok",
    *   ),
    *   @OA\Response(
    *       response=404,
    *       description="Post not found"
    *   )
    * )
    */
    public function show(Post $post)
    {
        return response()->json($post, Response::HTTP_OK);
    }

    /**
    * @OA\PUT(
    *   path="/api/post/{id}",
    *   summary="Update a specific post",
    *   tags={"Post"},
    *   @OA\Parameter(
    *       name="id",
    *       in="path",
    *       required=true,
    *       @OA\Schema(type="integer")
    *   ),
    *   @OA\RequestBody(
    *      @OA\JsonContent(
    *         required={"user_id","category_id", "image", "title", "slug", "text"},
    *         @OA\Property(
    *           property="user_id",
    *           type="int",
    *           example="156"
    *          ),
    *          @OA\Property(
    *           property="category_id",
    *           type="int",
    *           example="112"
    *          ),
    *          @OA\Property(
    *           property="image",
    *           type="string",
    *           example="https://via.placeholder.com/640x480.png/00ee11?text=asperiores"
    *          ),
    *          @OA\Property(
    *           property="title",
    *           type="string",
    *           example="Quisquam error debitis molestias adipisci nostrum"
    *          ),
    *          @OA\Property(
    *           property="slug",
    *           type="string",
    *           example="quisquam-error-debitis-molestias-adipisci-nostrum2"
    *          ),
    *          @OA\Property(
    *           property="text",
    *           type="string",
    *           example="Quidem et exercitationem repellendus eos maxime earum eligendi ipsam. Ab voluptatum ex ut suscipit. Veritatis neque et eius. Et accusamus hic minima quia laboriosam repellat. Deleniti corporis quis explicabo quasi reprehenderit porro. Optio vitae nostrum quia voluptatum rerum et facilis. Accusamus sit inventore aspernatur. Esse numquam sit id voluptatem et ullam itaque. Delectus ipsam excepturi neque sit impedit iusto porro. Qui doloribus ut pariatur quia aut. Ut illo et vel nihil repellendus sit dolore officia. Accusantium nobis ducimus numquam similique pariatur laboriosam. Ut sint iusto saepe. Animi nam ab odit omnis doloribus"
    *          ),
    *       )
    *   ),
    *   @OA\Response(
    *     response=200,
    *     description="Ok",
    *   ),
    *   @OA\Response(
    *     response=404,
    *     description="Post not found"
    *   )
    * )
    */
    public function update(Request $request, Post $post)
    {
        $validator = Post::validate($request->all());
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $post->update([
            'image' => $request->image,
            'title' => $request->title,
            'slug' => $request->slug,
            'text' => $request->text,
        ]);

        return response()->json($post, Response::HTTP_OK);
    }

    /**
    * @OA\DELETE(
    *      path="/api/post/{id}",
    *      summary="Delete a specific post",
    *      tags={"Post"},
    *      @OA\Parameter(
    *          name="id",
    *          in="path",
    *          required=true,
    *          @OA\Schema(type="integer")
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="Post deleted"
    *      ),
    *      @OA\Response(
    *          response=404,
    *          description="Post not found"
    *      )
    *  )
    */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json(['message' => 'Post deleted sucessfully'], Response::HTTP_OK);
    }
}
