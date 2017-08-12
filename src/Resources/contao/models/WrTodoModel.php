<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2016 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao;

/**
 * Class WrTodoModel
 *
 * @method static Model\Collection|ArticleModel[]|ArticleModel|null findAll($opt=array())
 */

class WrTodoModel extends \Model
{

	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_wr_todo';

}
