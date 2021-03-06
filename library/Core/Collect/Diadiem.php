<?php
/**
* @file: Diadiem.php
* @author: huuthanh3108@gmaill.com
* @date: 10-07-2012
* @company : http://dnict.vn
**/
class Core_Collect_Diadiem implements Core_Collect_Interface
{
	/**
	 *
	 * @static
	 * @return array
	 */
	public static function collect($params = array(),$option = array())
	{
		$model = Core::single('CoreBase/DbTable_Diadiem');
		/**
SELECT node.id,node.name, (node.level - parent.level) AS depth
FROM dvc_diadiem AS node
INNER JOIN dvc_diadiem AS parent ON node.lft BETWEEN parent.lft AND parent.rgt
WHERE parent.id = 3
ORDER BY node.lft;
		 */
		$select = $model->select()->setIntegrityCheck(false)
				->from(array('node'=>$model->info('name')),array('id','name','depth'=>new Zend_Db_Expr('(node.level + 1 - parent.level)')))
				->join(array('parent'=>$model->info('name')), 'node.lft BETWEEN parent.lft AND parent.rgt',array())
				->order('node.lft ASC')
		;
		if (isset($params['id'])) {
			$select->where('parent.id = ?',(int)$params['id'],'INTEGER');
		}elseif(isset($params['code'])){
			$select->where('parent.code = ?',$params['code'],'STRING');
		}
		else{
			$select->where('parent.id = 1');
		}
		if (isset($option['status'])) {
			$select->where('node.status = ?', $option['status'],'INTEGER');
		}
		//echo $select;
		/*
		$node_parent = $select->fetchRow();
		$select =  $model->select(array('id','name','level'))
						->join(array('parent'=>$model->info('name')), 'dd.id_parent = parent.id')
								->where('dd.lft >= ?',$node_parent->lft,'INTEGER')
								->where('dd.rgt <= ?',$node_parent->rgt,'INTEGER')
								->where('dd.status = 1')
								->order('dd.lft ASC');
		if (isset($option['notid'])) {
			$select->where('parent.id NOT IN (?)',$option['notid']);
		}
		*/
		$rows = $select->fetchAll();
		$result = array();
		for ($i = 0; $i < count($rows); $i++) {
			$string = '--';
			$newString = '';
			for($j=1;$j<$rows[$i]['depth']; $j++){
				$newString .= $string;
			}		
			$result[$rows[$i]['id']] = $newString.$rows[$i]['name'];
		}				
		return $result;
	}

	/**
	 *
	 * @static
	 * @param int $id
	 * @return string
	 */
	public static function getName($id,$option = array())
	{
		return Core::single('CoreBase/DbTable_Diadiem')->getNameById($id);
	}
}