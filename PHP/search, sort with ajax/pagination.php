<?php

class Pagination{
    public $baseURL        = '';
    public $totalRows      = '';
    public $perPage         = 10;
    public $numLinks        =  3;
    public $currentPage    =  0;
    public $firstLink       = '&lsaquo; First';
    public $nextLink        = '&gt;';
    public $prevLink        = '&lt;';
    public $lastLink        = 'Last &rsaquo;';
    public $fullTagOpen    = '<div class="pagination">';
    public $fullTagClose    = '</div>';
    public $firstTagOpen    = '';
    public $firstTagClose    = '&nbsp;';
    public $lastTagOpen    = '&nbsp;';
    public $lastTagClose    = '';
    public $curTagOpen        = '&nbsp;<b>';
    public $curTagClose    = '</b>';
    public $nextTagOpen    = '&nbsp;';
    public $nextTagClose    = '&nbsp;';
    public $prevTagOpen    = '&nbsp;';
    public $prevTagClose    = '';
    public $numTagOpen        = '&nbsp;';
    public $numTagClose    = '';
    public $anchorClass    = '';
    public $showCount      = true;
    public $currentOffset    = 0;
    public $contentDiv     = '';
    public $additionalParam= '';
    public $link_func      = '';

    function __construct($params = array()){
        if (count($params) > 0){
            $this->initialize($params);
        }

        if ($this->anchorClass != ''){
            $this->anchorClass = 'class="'.$this->anchorClass.'" ';
        }
    }

    function initialize($params = array()){
        if (count($params) > 0){
            foreach ($params as $key => $val){
                if (isset($this->$key)){
                    $this->$key = $val;
                }
            }
        }
    }

    /**
     * Generate the pagination links
     */
    function createLinks(){
       	// Neu so dong la 0 thi khong can nut tiep tuc
        if ($this->totalRows == 0 OR $this->perPage == 0){
            return '';
        }

        // Tinh toan tong so trang
        $numPages = ceil($this->totalRows / $this->perPage);

        // Neu chi co 1 page thi khong co nut continued
        if ($numPages == 1){
            if ($this->showCount){
                $info = 'Showing : ' . $this->totalRows;
                return $info;
            }else{
                return '';
            }
        }

        //Xac dinh trang hien tai
        if ( ! is_numeric($this->currentPage)){
            $this->currentPage = 0;
        }

        // Links content string variable
        $output = '';

        $this->numLinks = (int)$this->numLinks;

        // Neu nhap trang hien tai lon lon tong so trang thi hien trang cuoi cung
        if ($this->currentPage > $this->totalRows){
            $this->currentPage = ($numPages - 1) * $this->perPage;
        }

        $uriPageNum = $this->currentPage;

        $this->currentPage = floor(($this->currentPage / $this->perPage) + 1);

        // Tinh toan start, end
        $start = (($this->currentPage - $this->numLinks) > 0) ? $this->currentPage - ($this->numLinks - 1) : 1;
        $end   = (($this->currentPage + $this->numLinks) < $numPages) ? $this->currentPage + $this->numLinks : $numPages;

        // Hien thi nut First
        if  ($this->currentPage > $this->numLinks){
            $output .= $this->firstTagOpen
                . $this->getAJAXlink( '' , $this->firstLink)
                . $this->firstTagClose;
        }

        // Hien thi nut Prev
        if  ($this->currentPage != 1){
            $i = $uriPageNum - $this->perPage;
            if ($i == 0) $i = '';
            $output .= $this->prevTagOpen
                . $this->getAJAXlink( $i, $this->prevLink )
                . $this->prevTagClose;
        }

        // Write the digit links
        for ($loop = $start -1; $loop <= $end; $loop++){
            $i = ($loop * $this->perPage) - $this->perPage;

            if ($i >= 0){
                if ($this->currentPage == $loop){
                    $output .= $this->curTagOpen.$loop.$this->curTagClose;
                }else{
                    $n = ($i == 0) ? '' : $i;
                    $output .= $this->numTagOpen
                        . $this->getAJAXlink( $n, $loop )
                        . $this->numTagClose;
                }
            }
        }

        // Hien thi nut next
        if ($this->currentPage < $numPages){
            $output .= $this->nextTagOpen
                . $this->getAJAXlink( $this->currentPage * $this->perPage , $this->nextLink )
                . $this->nextTagClose;
        }

        // Hien thi nut last
        if (($this->currentPage + $this->numLinks) < $numPages){
            $i = (($numPages * $this->perPage) - $this->perPage);
            $output .= $this->lastTagOpen . $this->getAJAXlink( $i, $this->lastLink ) . $this->lastTagClose;
        }

        // Remove double slashes
        $output = preg_replace("#([^:])//+#", "\\1/", $output);

        // Add the wrapper HTML if exists
        $output = $this->fullTagOpen.$output.$this->fullTagClose;

        return $output;
    }

    function getAJAXlink( $count, $text) {
        if($this->link_func == '' && $this->contentDiv == '')
            return '<a href="'.$this->baseURL.'?'.$count.'"'.$this->anchorClass.'>'.$text.'</a>';

        $pageCount = $count?$count:0;
        if(!empty($this->link_func)){
            $linkClick = 'onclick="'.$this->link_func.'('.$pageCount.')"';
        }else{
            $this->additionalParam = "{'page' : $pageCount}";
            $linkClick = "onclick=\"$.post('". $this->baseURL."', ". $this->additionalParam .", function(data){
                       $('#". $this->contentDiv . "').html(data); }); return false;\"";
        }

        return "<a href=\"javascript:void(0);\" " . $this->anchorClass . "
                ". $linkClick .">". $text .'</a>';
    }
}
?>