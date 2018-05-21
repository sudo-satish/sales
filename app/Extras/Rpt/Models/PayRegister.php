<?php
 
class Report_Model_PayRegister extends FE_Report_Model_PHPExcel {
	
	public function __construct(){
		parent::__construct();
	}

	public function getLocDepData($legalEntity,$locationId) {
		$query = "select * from `fe_hrm_location_m` where `attribute1`='".$locationId."' and `attribute49`='".$legalEntity."'";
		return $this->_db->fetchAll($query);
	}
	
	public function getLocData($legalEntity) {
		$query = "select * from `fe_hrm_location_m` where `attribute49`='".$legalEntity."'";
		return $this->_db->fetchAll($query);
	}
	
	public function getLegalEntity($eGroup) {
		$query = "select * from `fe_adm_legal_entity_m` where `attribute10`='".$eGroup."'";
		return $this->_db->fetchAll($query);
	}
	public function getDistributer() {
		$query = "select * from `fe_adm_legal_entity_m` where `attribute10`='".$this->getParam2()."'";
		if($this->getParam3() != ''){
			$query.= " and attribute1 = ".$this->getParam3();
		}
		
		return $this->_db->fetchAll($query);
	}
	
	public function getBussGroupName($eGroup) {
		$query = "select `attribute4` from `fe_adm_business_group_m` where `attribute1`='".$eGroup."'";
		return $this->_db->fetchOne($query);
	}
	
	public function getProDate($proDate) {
		$query = "select date_format(str_to_date('".$proDate."','%m/%Y'),'%b-%Y')";
		return $this->_db->fetchOne($query);
	}
	  
	public function getSalaryDraftHeader() {
		
		$query = "SELECT DISTINCT c.attribute9 comp_type,
                                                                CASE
                                                                                WHEN SUBSTR(c.attribute3,1,3)= 'PT_' AND c.attribute3!='PT_A' THEN 'PT'
                                                                                WHEN SUBSTR(c.attribute3,1,3)='LWF' THEN 'LWF'
                                                                                ELSE c.attribute13 
                                                                END comp
                                                                FROM fe_pym_sal_comp_m c
                                                                where 1=1
                                                                AND `c`.`attribute18`='Y'
                                                                and c.attribute46={$_SESSION['client']['id']}
                                                                and c.attribute47={$_SESSION['lgs']['id']}
                                                                ORDER BY CAST(`c`.`attribute21` AS SIGNED) ASC  ";
		
		/*$query = "SELECT DISTINCT `c`.`attribute9` `comp_type`,
				  CASE
				  		WHEN SUBSTR(`c`.`attribute3`,1,3)= 'PT_' AND `c`.`attribute3`!='PT_A' THEN 'PT'
						WHEN SUBSTR(`c`.`attribute3`,1,3)='LWF' THEN 'LWF'
				  		ELSE `c`.`attribute13`
				  END `comp`
				  FROM `fe_hrt_emp_info_t` `e`
				  LEFT JOIN `fe_pyt_emp_sal_draft_t` `d` ON(`d`.`attribute3`=`e`.`attribute1`)
				  LEFT JOIN `fe_pym_sal_comp_m` `c` ON(`c`.`attribute1`=`d`.`attribute2`)
				  join `XXDAGV__fe_dag_pyt_v__DAGVXX` `dag` on (`e`.`attribute16`=`dag`.`rule3` and `e`.`attribute1`=`dag`.`emp_id`)
				  WHERE 1=1
				  XXDAGWXX
				  and d.attribute8 = '".$this->getParam14()."' -- new line added payroll_month
				  AND( CURDATE() BETWEEN STR_TO_DATE(`e`.`attribute22`,'%m/%d/%Y') AND STR_TO_DATE(`e`.`attribute23`,'%m/%d/%Y'))
				  ORDER BY CAST(`c`.`attribute21` AS SIGNED) ASC
		"; 
				
			*/	
		return $query;
		
		/*$result = $this->_db->fetchAll($query);
		if(is_array($result) && count($result)>1) {
			return $result;
		}
		else {
			return null;
		}*/ 
	}
	
	public function getSalaryDraft($legalEntityId) { 
			
		$query = "SELECT 
                `e`.`attribute11`  `emp_no`,
                CONCAT(TRIM(`e`.`attribute4`),' ',IF(IFNULL(TRIM(`e`.`attribute5`),'')='','',CONCAT(TRIM(`e`.`attribute5`),' ')),IFNULL(TRIM(`e`.`attribute6`),'')) `employee`,
                DATE_FORMAT(STR_TO_DATE(`e`.`attribute12`,'%m/%d/%Y'),'%d-%b-%Y') `hiring_date`,
                DATE_FORMAT(STR_TO_DATE(`e`.`attribute13`,'%m/%d/%Y'),'%d-%b-%Y') `joining_date`,
                IF(IFNULL(ter.attribute20, '') = 'Y', DATE_FORMAT(STR_TO_DATE(`ter`.`attribute8`,'%m/%d/%Y'),'%d-%b-%Y'), '') `lwd`,
                DATE_FORMAT(LAST_DAY(STR_TO_DATE('".$this->getParam14()."','%m/%Y')),'%d-%b-%Y') `d_pay_date`,
                DAY(LAST_DAY(STR_TO_DATE('".$this->getParam14()."','%m/%Y'))) `std_days`,
                `loc`.`attribute4` `location`,
                `dg`.`attribute2` `designation`,
                `dp`.`attribute2` `department`,
                `le`.`attribute2` `legal_entity`,
                `ct`.`attribute2` `cost_centre`,
                IFNULL(lp.meaning,'N/A') `pt_location`,
                lok.attribute4 `state`,
                CASE IFNULL(eb.attribute4,'')
					WHEN 'BNK' THEN bk.attribute3 
					WHEN 'NEFT' THEN IF(le.attribute28 = 'LEC0000001', CONCAT(eb.attribute4, ' (', bk.attribute3, ')'), eb.attribute4)
					WHEN 'CHQ' THEN 'Cheque'
					WHEN 'DD' THEN 'DD'
					WHEN '' THEN 'Cheque'
				END bank_name,
                CASE `eb`.`attribute4`
                                                WHEN 
                                                	'DD' THEN `eb`.`attribute5`
                                                ELSE 
													`eb`.`attribute7`
                                                END  `acct_no`,
                IFNULL(li.attribute7, '') panNo,
				IFNULL(li.attribute10, '') pfNo,
				IFNULL(li.attribute11, '') esiNo,
                ROUND(`ctc`.`attribute8`/12,0) `ctc`, 
                `bt`.`attribute8` `working_days`, 
                `bt`.`attribute6` `lop_days`,
                `bt`.`attribute7` `lopr_days`,
                IF(IFNULL(bt.attribute13, '') = '', 'PAID', bt.attribute13) payment_status,
                `lband`.`attribute2`  `grade_name`,
                `c`.`attribute9` `comp_type`,
                `c`.`attribute3` `comp_code`,
                CASE
                                                WHEN SUBSTR(`c`.`attribute3`,1,3)= 'PT_' AND `c`.`attribute3`!='PT_A' THEN 'PT'
                                                WHEN SUBSTR(`c`.`attribute3`,1,3)='LWF' THEN 'LWF'
                                                ELSE `c`.`attribute13`
                END `comp_name`,
                CASE
                                                WHEN 
													`c`.`attribute3` = 'I_TAX' AND SUM(d.attribute4) < 0 THEN 0
                                                WHEN 
													SUBSTR(`c`.`attribute3`,1,3) = 'LWF' THEN `fe_pay_get_draft_val_f`(`d`.`attribute3`,'".$this->getParam14()."',`c`.`attribute3`,d.attribute14)
                                                ELSE  
													ROUND(SUM(d.attribute4), 0) 
                END `amount`
			FROM 
                `fe_pyt_emp_sal_draft_t` `d`
                JOIN `fe_pym_sal_comp_m` `c` ON(`c`.`attribute1`=`d`.`attribute2`)
                JOIN `fe_hrt_emp_info_t` `e` ON(`d`.`attribute3`=`e`.`attribute1` AND `d`.`attribute14`=`e`.`attribute16`)
                JOIN `fe_hrt_emp_job_t` `j` ON(
                	`e`.`attribute1`=`j`.`attribute2` 
                	AND `e`.`attribute16`=`j`.`attribute19` 
                	AND IF('".$this->getParam4()."'='','',j.attribute5)=IF('".$this->getParam4()."'='','','".$this->getParam4()."') 
                	AND IF('".$this->getParam7()."'='','',j.attribute16)=IF('".$this->getParam7()."'='','','".$this->getParam7()."')
                )
                JOIN `fe_adm_legal_entity_m` `le` ON(
                	`e`.`attribute16` = `le`.`attribute1`  
                	and if('".$this->getParam2()."'='','#',`le`.`attribute10`)=if('".$this->getParam2()."'='','#','".$this->getParam2()."')
                )
                JOIN fe_hrt_emp_terminate_t ter ON (ter.attribute2 = e.attribute1 AND ter.attribute21 = e.attribute16 AND STR_TO_DATE(ter.attribute3, '%m/%d/%Y') = STR_TO_DATE(e.attribute13, '%m/%d/%Y'))
                LEFT JOIN `fe_hrm_location_m` `loc` ON(`j`.`attribute5` = `loc`.`attribute1`)
                LEFT JOIN `fe_pyt_emp_ctc_t` `ctc` ON(`ctc`.`attribute2` = `e`.`attribute1` AND ctc.attribute7=e.attribute16 AND `ctc`.`attribute14` = 'A' AND IF(ter.attribute20 = 'Y', STR_TO_DATE(ter.attribute8, '%m/%d/%Y'), LAST_DAY(STR_TO_DATE('".$this->getParam14()."','%m/%Y'))) BETWEEN STR_TO_DATE(`ctc`.`attribute3`,'%m/%d/%Y') AND STR_TO_DATE(`ctc`.`attribute4`,'%m/%d/%Y'))
                LEFT JOIN `fe_hrm_designation_ff_m` `dg` ON(`j`.`attribute3` = `dg`.`attribute1`)
                LEFT JOIN `fe_hrm_department_m` `dp` ON(`j`.`attribute13` = `dp`.`attribute1`)
                LEFT OUTER JOIN `fe_pyt_emp_sal_bt_t` `bt` ON (
                	`bt`.`attribute2`=`e`.`attribute1` AND `bt`.`attribute5`=`e`.`attribute16`
                	AND bt.attribute22='SALARY'
                	AND STR_TO_DATE(`bt`.`attribute4`,'%m/%Y') = STR_TO_DATE('".$this->getParam14()."','%m/%Y')
                )
                LEFT OUTER JOIN `fe_hrm_cost_centre_m` `ct` ON(`ct`.`attribute1` = `j`.`attribute14`)
                LEFT OUTER JOIN `fe_hrt_emp_bank_t` `eb` ON (`eb`.`attribute2` = `e`.`attribute1` AND `eb`.`attribute9` = 'Y' AND eb.attribute49=e.attribute16 AND IF(IFNULL(eb.attribute11, '') = '', 'TYPE_SAL', eb.attribute11) = 'TYPE_SAL')
                LEFT OUTER JOIN `fe_hrm_bank_m` `bk` ON(`bk`.`attribute1`=`eb`.`attribute3`)
                LEFT OUTER JOIN `fe_hrm_band_m` `lband` ON(`lband`.`attribute1` = `j`.`attribute17` AND lband.attribute49 = j.attribute19)
                LEFT OUTER JOIN fe_hrt_emp_legal_info_t li ON (
                	li.attribute2=e.attribute1 
                	AND li.attribute9=e.attribute16
                	AND LAST_DAY(STR_TO_DATE('".$this->getParam14()."','%m/%Y')) BETWEEN STR_TO_DATE(`li`.`attribute42`,'%m/%d/%Y') AND STR_TO_DATE(`li`.`attribute43`,'%m/%d/%Y')
                )
                -- LEFT OUTER JOIN fe_pym_pt_info_m pi ON (pi.attribute1=li.attribute14)
                -- LEFT OUTER JOIN fe_pym_gov_address_m ga ON (ga.attribute1=pi.attribute2)
                -- LEFT OUTER JOIN fe_pym_pt_m pt ON (pt.attribute1=ga.attribute18)
                LEFT OUTER JOIN fe_pym_pt_m pt ON (pt.attribute1=li.attribute14)
                LEFT OUTER JOIN aureole_lookup lp ON (
                	lp.code=pt.attribute2 
                	AND lp.translation_type='PT_LOC' 
                	AND lp.client_id={$_SESSION['client']['id']} 
                	AND lp.legislation_id={$_SESSION['lgs']['id']}
                ) 
				LEFT JOIN fe_adm_state_m lok ON (lok.attribute3 = loc.attribute16)
				-- LEFT JOIN aureole_lookup lok ON (lok.code=loc.attribute16 AND lok.translation_type=loc.attribute21 AND lok.client_id=fe_get_client_id_f() AND lok.legislation_id=fe_get_legislation_id_f())
                JOIN `XXDAGV__fe_dag_pyt_v__DAGVXX` `dag` ON (`e`.`attribute16`=`dag`.`rule3` AND `e`.`attribute1`=`dag`.`emp_id`)
                LEFT OUTER JOIN `fe_pyt_emp_fnf_t` f ON(
					`d`.`attribute3` = `f`.`attribute2` 
					AND `d`.`attribute14` = `f`.`attribute21` 
					AND STR_TO_DATE(`f`.`attribute18`,'%m/%Y') = STR_TO_DATE('".$this->getParam14()."','%m/%Y')
					AND IFNULL(f.attribute22,'') != 'NP' 
				)
			WHERE 1=1
				XXDAGWXX
				and d.attribute14 = $legalEntityId
                -- AND if('".$this->getParam3()."'='','#',`d`.`attribute14`)=if('".$this->getParam3()."'='','#','".$this->getParam3()."')
                AND IFNULL(`c`.`attribute9`,'#') != '#'
                AND `c`.`attribute18` = 'Y'
                AND STR_TO_DATE(`d`.`attribute8`,'%m/%Y') = STR_TO_DATE('".$this->getParam14()."','%m/%Y')
                AND `f`.`attribute1` IS NULL
                AND LAST_DAY(STR_TO_DATE('".$this->getParam14()."','%m/%Y')) BETWEEN STR_TO_DATE(`e`.`attribute22`,'%m/%d/%Y') AND STR_TO_DATE(`e`.`attribute23`,'%m/%d/%Y')
                AND LAST_DAY(STR_TO_DATE('".$this->getParam14()."','%m/%Y')) BETWEEN STR_TO_DATE(`j`.`attribute11`,'%m/%d/%Y') AND STR_TO_DATE(`j`.`attribute12`,'%m/%d/%Y')
                -- AND LAST_DAY(STR_TO_DATE('".$this->getParam14()."','%m/%Y')) BETWEEN STR_TO_DATE(`li`.`attribute42`,'%m/%d/%Y') AND STR_TO_DATE(`li`.`attribute43`,'%m/%d/%Y')
                -- and d.attribute3 = 111717
			GROUP BY `d`.`attribute2`,`d`.`attribute3`
			ORDER BY `e`.`attribute11` ";
	
		return $query;
	 
	
	}	
}

