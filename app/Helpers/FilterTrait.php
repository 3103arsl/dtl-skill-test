<?php

namespace App\Helpers;

trait FilterTrait {

    private $keyword;
    private $params;

    public function setParams($params) {
        $this->params = $params;
    }

    public function setKeyword($keyword) {
        $this->keyword = $keyword;
        return $this;
    }

    public function getKeyword() {
       return ($this->params->has('search')) ? '%' . strtolower($this->params->input('search')) .'%' : '';
    }

    public function getSortBy() {
        return ($this->params->has('sort_by')) ? $this->params->input('sort_by') : 'id';
    }

    public function getSortOrder() {
        return ($this->params->has('sort_order')) ? $this->params->input('sort_order') : 'ASC';
    }

    public function getPerPage() {
        return ($this->params->has('per_page')) ? $this->params->input('per_page') : self::NUMBER_OF_RECORDS;
    }

    public function getColumns() {
        return ($this->params->has('columns')) ? $this->params->input('columns') : [];
    }

    public function hasKeyword() {
        return $this->params->has('search');
    }
}
