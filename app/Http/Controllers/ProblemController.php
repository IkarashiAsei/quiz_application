<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Problem;
use App\Models\Choice;
use Illuminate\Support\Facades\DB;


class ProblemController extends Controller
{
    public function index($id) {
        
        // $idは問題番号
        $min_id = Problem::limit(1)->first()->id;

        if ($id == $min_id) {
            // 一問目だったら、正解数を0とする。
            Cache::put('count', 0);   
        }

        // 問題テーブルから該当する問題を取得する。
        $problem = Problem::find($id);
        
        // 問題の有無を判定。
        if(empty($problem)) {
            // end
            return view('end',['count' => Cache::get('count')]);
        } else {
            // next
            //その問題に紐ずく選択肢（テーブル）のidを取得。
            $choice_id = $problem->choice_id;
            // 選択肢テーブルから該当する選択肢を取得する。
            $choice = Choice::select('*')->where('id',$choice_id)->first();
            // 問題と選択肢を画面に表示する。
            return view('index',['problem' => $problem, 'choice' => $choice]);
        }
    }

    public function answer($id, $number) {
    
        // 問題テーブルから該当する問題を取得する。
        $problem = Problem::find($id);
      
       //その問題に紐ずく選択肢（テーブル）のidを取得。
       $choice_id = $problem->choice_id;
        $answer = Choice::select('*')
            ->where('id',$choice_id) // 該当の選択肢を取得する。
            ->where('answer',$number) // 選択肢の答え（番号）を絞り込む。
            ->get();
    
        // データが一件以上だったら 
        if(count($answer) >= 1) {
            // 正解
            $count = Cache::get('count');
            Cache::put('count', intval($count) + 1);   
        } else {
            // 不正解
        }

        
       // 選択肢テーブルから該当する選択肢を取得する。
       $choice = Choice::select('*')->where('id',$choice_id)->first();

       // 次の問題のid
        $next_id = Problem::where('id', '>', $id)
                ->limit(1)->first();
                
        if (is_null($next_id)) {
            $next_id = 9999;
        }
        return view('index',[
            'problem' => $problem,
            'choice' => $choice,
            'answer' => count($answer),
            'next_id' => $next_id,
        
        ]);
    }

    /**
     * 問題一覧画面
     */
    public function list() {
        $problems = Problem::select('problems.id', 'problems.name')
            ->get();
            
        return view('list', ['problems' => $problems]);
    }

    /**
     * 新規登録画面
     */
    public function create() {
        return view('edit');
    }

    /**
     * 新規登録処理
     */
    public function register(Request $request) {
        $name = $request->input('name');
        $choice_1 = $request->input('choice_1');
        $choice_2 = $request->input('choice_2');
        $choice_3 = $request->input('choice_3');
        $choice_4 = $request->input('choice_4');
        $answer = $request->input('answer');

        DB::beginTransaction();
        try {
            $choice_id = Choice::create([
                'choice_1' => $choice_1,
                'choice_2' => $choice_2,
                'choice_3' => $choice_3,
                'choice_4' => $choice_4,
                'answer' => $answer,
            ])->id;
            
            Problem::create([
                'name' => $name,
                'choice_id' => $choice_id,
            ]);
            DB::commit();

            $message = '登録しました';
        } catch (\Exception $e) {
            $message = 'エラーが発生しました';
            DB::rollback();
        } 
    

        return view('edit', ['message' => $message]);
    }

    /**
     * 編集画面
     */
    public function edit($id) {
        $problem = Problem::select('problems.id', 'problems.name', 'problems.choice_id', 'choices.choice_1', 'choices.choice_2', 'choices.choice_3', 'choices.choice_4', 'choices.answer')
            ->join('choices', 'choices.id', '=', 'problems.choice_id')
            ->where('problems.id', $id)
            ->first();

            
        return view('edit', ['problem' => $problem]);
    }

    /**
     * 更新処理
     */
    public function update(Request $request) {
        $problem_id = $request->input('problem_id');
        $choice_id = $request->input('choice_id');
        $name = $request->input('name');
        $choice_1 = $request->input('choice_1');
        $choice_2 = $request->input('choice_2');
        $choice_3 = $request->input('choice_3');
        $choice_4 = $request->input('choice_4');
        $answer = $request->input('answer');

        DB::beginTransaction();
        try {
            Choice::where('id', $choice_id)
                ->update([
                'choice_1' => $choice_1,
                'choice_2' => $choice_2,
                'choice_3' => $choice_3,
                'choice_4' => $choice_4,
                'answer' => $answer,
            ]);

            Problem::where('id', $problem_id)
                ->update([
                    'name' => $name,
                    'choice_id' => $choice_id,
                ]);
            DB::commit();

            $message = '登録しました';
        } catch (\Exception $e) {
            $message = 'エラーが発生しました';
            DB::rollback();
        } 
    

        return view('edit', ['message' => $message]);
    }

    /**
     * 削除処理
     */
    public function destory($id) {
        $problem = Problem::find($id);
        $problems = Problem::select('problems.id', 'problems.name')
            ->get();
            
        DB::beginTransaction();
        try {
        
            $choice = Choice::find($problem->choice_id);
            $choice->delete();
            $problem = Problem::find($id);
            $problem->delete();

            DB::commit();
            $message = '削除しました';
        } catch (\Exception $e) {
            $message = 'エラーが発生しました';
            DB::rollback();
        }

        return view('list', ['problems' => $problems, 'message' => $message]);
    }
}
