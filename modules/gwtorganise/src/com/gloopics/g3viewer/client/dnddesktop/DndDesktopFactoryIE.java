package com.gloopics.g3viewer.client.dnddesktop;

public class DndDesktopFactoryIE extends DndDesktopFactory{
	
	public DesktopDropBase getInstance(DesktopDroppableWidget a_Widget)
	{
		return new DesktopDropFileIE(a_Widget);
	}
}
