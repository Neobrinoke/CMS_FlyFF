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
		if (!$article->authorized_comment) {
			abort(404);
		}

		$validateData = $request->validate([
			'content' => 'required|max:250'
		]);

		$validateData['article_id'] = $article->id;
		$validateData['author_id'] = Auth::id();

		ArticleComment::query()->create($validateData);

		$request->session()->flash('success', trans('site.article.comment.submit_messages.success'));

		return redirect()->route('article.show', [
			'article' => $article
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
		//
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

			$request->session()->flash('success', trans('site.article.comment.submit_messages.delete'));
		}

		return redirect()->route('article.show', [
			'article' => $article
		]);
	}
}
