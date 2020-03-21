<?php  

/**
 * summary
 */
class Media
{
    /**
     * summary
     */
    protected $mdId;
    protected $title;
    protected $auth;
    protected $img;
    protected $descr;
    protected $isbn;
    protected $pblshr;
    protected $pDate;
    protected $status;
    protected $type;


    public function __construct($mdId,$title,$author,$img,$description,$ISBN,$publisher,$publishDate,$status,$type)
    {
        $this->mdId = $mdId;
        $this->title = $title;
	    $this->auth = $author;
	    $this->img = $img;
	    $this->descr = $description;
	    $this->isbn = $ISBN;
	    $this->pblshr = $publisher;
	    $this->pDate = $publishDate;
	    $this->status = $status;
	    $this->type = $type;
    }
    public function printCards()
    {
    	if ($this->status == 0) {
            $msg = 'Not available';            
        } else {$msg = 'Order in our office';}
        return '<div class="col-3 p-3">
	    			<div class="card">
		    			<img class="card-img-top img-fluid" src="'.$this->img.'" alt="Card image">
		    			<div class="card-body">
		    				<a href="library.php?itm='.$this->mdId.'" class="stretched-link">
                                <h3 class="card-title">'.$this->title.'</h3>
                            </a>
		    				<p class="card-text font-weight-bold">'.$this->auth.'</p>
		    				<p class="card-text">'.$msg.'</p>
		    			</div>
	    			</div>
    			</div>';
                //<button type="button" class="btn btn-warning" name="btn-order">Order</button>
    }
    public function printDetails()
    {
    	return '<div class="col-3 p-3">
					<img class="img-fluid" src="'.$this->img.'">
    			</div>
    			<div class="col-9 p-3">
    				<h4>'.$this->title.'</h4>
    				<h3>'.$this->auth.'</h3>
    				<p>'.$this->descr.'</p>
    				<p>ISBN-10: '.$this->isbn.' | Publisher: '.$this->pblshr.' ('.$this->pDate.')</p>
    			</div>';
    }
}
?>