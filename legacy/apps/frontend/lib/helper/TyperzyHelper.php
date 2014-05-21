<?php
function link_to_typ_edytuj(Mecz $mecz )
{
	if($mecz->getAktywny())
	{
		$typ = $mecz -> getTwojTyp();
		return $typ ? link_to(image_tag('/images/icons/target.png'), '@typ_edit?typ='.$typ->getId()) : link_to(image_tag('/images/icons/target.png'),'@typ_create?mecz='.$mecz -> getId());
	} 
	else
	{
		return;
		if($mecz->getRozegrany())
		{
			return 'rozegrany';
		}
		else
		{
			return 'w trakcie';
		}
	}
}
?>