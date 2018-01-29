<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/28/2018
 * Time: 11:29 PM
 */

namespace IB\Controllers\Admin;


use IB\Common\HelperIb;
use IB\Common\Views;
use IB\Controllers\Interfaces\ControllerInterface;
use IB\Modules\Forms\FormsService;
use IB\Modules\Pages\PageGenerator;
use Qpdb\QueryBuilder\QueryBuild;
use Slim\Http\Request;
use Slim\Http\Response;

class FormsControllerEditProcess implements ControllerInterface
{

	/**
	 * @var PageGenerator
	 */
	private $page;

	/**
	 * @var int
	 */
	private $formId;

	/**
	 * RegisterController constructor.
	 */
	public function __construct()
	{
		$this->page = new PageGenerator();
	}

	/**
	 * @param Request $request
	 * @param Response $response
	 * @param array $args
	 * @return int|Response
	 * @throws \IB\Common\ViewsException
	 */
	public function indexAction( Request $request, Response $response, array $args = [] )
	{
		$this->page->withContent( Views::loadView('common/alerts.php', ['message'=>'Update succesfull', 'messageType'=>'alert-success']) );
		//echo "<pre>" . print_r($request->getParsedBody(),1) . "</pre>";
		$this->updateForm( $request->getParsedBody() );

		return $response->getBody()->write( $this->page->getMarkupContent( false ) );
	}

	private function updateForm( $data )
	{
		$this->formId = $data['form_id'];
		FormsService::getInstance()->updateFormById($data['form_id'], ['form_name'=>$data['form_name']]);

		if(isset($data['quiz_options'])){
			$this->updateOldQuiz($data['quiz_options']);
		} else {
			QueryBuild::delete('quiz')->whereEqual('form_id', $this->formId)->execute();
		}

		if(isset($data['quiz_options_new']))
			$this->insertNewQuizOptions($data['quiz_options_new']);
	}

	private function updateOldQuiz($oldQuiz)
	{
		$existent = [];
		foreach ($oldQuiz as $quiz_id => $quiz){
			$existent[] = $quiz_id;
			$update = [
				'quiz_question' => $quiz['q'],
				'quiz_options' => HelperIb::jsonEncode($quiz['r'])
			];
			QueryBuild::update('quiz')
				->setFieldsByArray($update)
				->whereEqual('quiz_id', $quiz_id)
				->execute();
		}
		if(count($existent))
			QueryBuild::delete('quiz')
				->whereEqual('form_id', $this->formId)
				->whereNotIn('quiz_id',$existent)
				->execute();
	}

	private function insertNewQuizOptions( $newQuiz )
	{
		foreach ($newQuiz as $quiz){
			$update = [
				'quiz_question' => $quiz['q'],
				'quiz_options' => HelperIb::jsonEncode($quiz['r']),
				'form_id' => $this->formId
			];
			QueryBuild::insert('quiz')
				->setFieldsByArray($update)
				->execute();
		}
	}


}