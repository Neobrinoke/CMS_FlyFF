<?php

namespace App\Http\Controllers;

use App\Model\Web\Article;
use App\Model\Web\ArticleComment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ArticleCommentController extends Controller
{
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @param Article $article
	 * @return Response
	 */
	public function store(Request $request, Article $article)
	{
		if ($article->authorized_comment) {
			$validateData = $request->validate([
				'content' => 'required|max:250'
			]);

			$validateData['article_id'] = $article->id;
			$validateData['author_id'] = Auth::id();

			ArticleComment::query()->create($validateData);

			$request->session()->flash('status', trans('site.article.comment.submit_comment.comment.create'));
		}

		return redirect()->route('article.show', [
			'article' => $article,
			'slug' => $article->slug
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request
	 * @param Article $article
	 * @param ArticleComment $articleComment
	 * @return Response
	 */
	public function update(Request $request, Article $article, ArticleComment $articleComment)
	{
		if ($article->authorized_comment && $articleComment->is_mine) {
			$validateData = $request->validate([
				'content' => 'required|max:250'
			]);

			$articleComment->fill($validateData);
			$articleComment->save();

			$request->session()->flash('status', trans('site.article.comment.submit_comment.comment.edit'));
		}

		return redirect()->route('article.show', [
			'article' => $article,
			'slug' => $article->slug
		]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param Request $request
	 * @param Article $article
	 * @param ArticleComment $articleComment
	 * @return Response
	 */
	public function destroy(Request $request, Article $article, ArticleComment $articleComment)
	{
		if ($article->authorized_comment && $articleComment->is_mine) {
			$articleComment->forceDelete();

			$request->session()->flash('status', trans('site.article.comment.submit_comment.comment.delete'));
		}

		return redirect()->route('article.show', [
			'article' => $article,
			'slug' => $article->slug
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request
	 * @param Article $article
	 * @param ArticleComment $articleComment
	 * @return Response
	 */
	public function storeResponse(Request $request, Article $article, ArticleComment $articleComment)
	{
		if ($article->authorized_comment) {
			$validateData = $request->validate([
				'content' => 'required|max:250'
			]);

			$validateData['article_id'] = $article->id;
			$validateData['author_id'] = Auth::id();
			$validateData['comment_id'] = $articleComment->id;

			ArticleComment::query()->create($validateData);

			$request->session()->flash('status', trans('site.article.comment.submit_comment.response.create'));
		}

		return redirect()->route('article.show', [
			'article' => $article,
			'slug' => $article->slug
		]);
	}
}
