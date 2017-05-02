<?php
namespace App\Decorator;

class WebDecorator
{
    /**
    * @var array $gridState contain rows of grid
    * @var int $gridRow contain row count
    * @var int $gridCol contain col count
    * @var string $shotMessage contain string message
    * @var string|null $finalMessage contain final string message
    */

    private $gridState;
    private $gridRow;
    private $gridCol;
    private $shotMessage;
    private $finalMessage;
    private $view;

    /**
    * @param array $gridState;
    * @param array $gridState;
    * @param int $gridRow;
    * @param int $gridCol;
    * @param string $shotMessage;
    * @param string $finalMessage;
    */
    public function __construct(
        $gridState,
        $gridRow,
        $gridCol,
        $shotMessage,
        $finalMessage
        ) {
        $this->gridState = $gridState;
        $this->gridCol = $gridCol;
        $this->gridRow = $gridRow;
        $this->shotMessage = $shotMessage;
        $this->finalMessage = $finalMessage;
        $this->view = new \App\Utilities\View();
    }

    /**
    * Set variables to template
    *
    * @return void
    */
    private function setVarToTemplate()
    {
        // Set grid variable to template with game grid
        $this->view->set('grid', $this->gridState);

        // Set variable with shot message to template
        $this->view->set('shotMessage', $this->shotMessage);

        // Set variable with final message to template
        $this->view->set('finalMessage', $this->finalMessage);

        // Set variable with grid row count to template
        $this->view->set('gridRowCount', $this->gridRow);

        // Set variable with grid colum count to template
        $this->view->set('gridColCount', $this->gridCol);
    }

    /**
    * Decorate Cli view
    *
    * @return string
    */
    public function cliDecorate()
    {
        //Set variables to Cli index template
        $this->setVarToTemplate();

        // Set path to template
        $this->view->setFile('Cli', 'index');
        
        // Return generated template
        return $this->view->output();
    }

    /**
    * Decorate Web view
    *
    * @return string
    */
    public function webDecorate()
    {
        //Set variables to Web index template
        $this->setVarToTemplate();

        // Set path to template
        $this->view->setRender('Web', 'index');

        // Render sub template
        $viewTable = $this->view->render();

        // Set main variable to render sub template to main template
        $this->view->set('viewElement', $viewTable);
            
        // Set main template
        $this->view->setFile('', 'index');

        // Return generated template
        return $this->view->output();
    }
}
