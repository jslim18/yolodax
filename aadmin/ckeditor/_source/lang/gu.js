/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Gujarati language.
 */

/**#@+
   @type String
   @example
*/

/**
 * Constains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['gu'] =
{
	/**
	 * The language reading direction. Possible values are "rtl" for
	 * Right-To-Left languages (like Arabic) and "ltr" for Left-To-Right
	 * languages (like English).
	 * @default 'ltr'
	 */
	dir : 'ltr',

	/*
	 * Screenreader titles. Please note that screenreaders are not always capable
	 * of reading non-English words. So be careful while translating it.
	 */
	editorTitle : 'Rich text editor, %1, press ALT 0 for help.', // MISSING

	// ARIA descriptions.
	toolbar	: 'Toolbar', // MISSING
	editor	: 'Rich Text Editor', // MISSING

	// Toolbar buttons without dialogs.
	source			: 'મૂળ કે પ્રાથમિક દસ્તાવેજ',
	newPage			: 'નવુ પાનું',
	save			: 'સેવ',
	preview			: 'પૂર્વદર્શન',
	cut				: 'કાપવું',
	copy			: 'નકલ',
	paste			: 'પેસ્ટ',
	print			: 'પ્રિન્ટ',
	underline		: 'અન્ડર્લાઇન, નીચે લીટી',
	bold			: 'બોલ્ડ/સ્પષ્ટ',
	italic			: 'ઇટેલિક, ત્રાંસા',
	selectAll		: 'બઘું પસંદ કરવું',
	removeFormat	: 'ફૉર્મટ કાઢવું',
	strike			: 'છેકી નાખવું',
	subscript		: 'એક ચિહ્નની નીચે કરેલું બીજું ચિહ્ન',
	superscript		: 'એક ચિહ્ન ઉપર કરેલું બીજું ચિહ્ન.',
	horizontalrule	: 'સમસ્તરીય રેખા ઇન્સર્ટ/દાખલ કરવી',
	pagebreak		: 'ઇન્સર્ટ પેજબ્રેક/પાનાને અલગ કરવું/દાખલ કરવું',
	unlink			: 'લિંક કાઢવી',
	undo			: 'રદ કરવું; પહેલાં હતી એવી સ્થિતિ પાછી લાવવી',
	redo			: 'રિડૂ; પછી હતી એવી સ્થિતિ પાછી લાવવી',

	// Common messages and labels.
	common :
	{
		browseServer	: 'સર્વર બ્રાઉઝ કરો',
		url				: 'URL',
		protocol		: 'પ્રોટોકૉલ',
		upload			: 'અપલોડ',
		uploadSubmit	: 'આ સર્વરને મોકલવું',
		image			: 'ચિત્ર',
		flash			: 'ફ્લૅશ',
		form			: 'ફૉર્મ/પત્રક',
		checkbox		: 'ચેક બોક્સ',
		radio			: 'રેડિઓ બટન',
		textField		: 'ટેક્સ્ટ ફીલ્ડ, શબ્દ ક્ષેત્ર',
		textarea		: 'ટેક્સ્ટ એરિઆ, શબ્દ વિસ્તાર',
		hiddenField		: 'ગુપ્ત ક્ષેત્ર',
		button			: 'બટન',
		select			: 'પસંદગી ક્ષેત્ર',
		imageButton		: 'ચિત્ર બટન',
		notSet			: '<સેટ નથી>',
		id				: 'Id',
		name			: 'નામ',
		langDir			: 'ભાષા લેખવાની પદ્ધતિ',
		langDirLtr		: 'ડાબે થી જમણે (LTR)',
		langDirRtl		: 'જમણે થી ડાબે (RTL)',
		langCode		: 'ભાષા કોડ',
		longDescr		: 'વધારે માહિતી માટે URL',
		cssClass		: 'સ્ટાઇલ-શીટ ક્લાસ',
		advisoryTitle	: 'મુખ્ય મથાળું',
		cssStyle		: 'સ્ટાઇલ',
		ok				: 'ઠીક છે',
		cancel			: 'રદ કરવું',
		close			: 'Close', // MISSING
		preview			: 'Preview', // MISSING
		generalTab		: 'General', // MISSING
		advancedTab		: 'અડ્વાન્સડ',
		validateNumberFailed : 'This value is not a number.', // MISSING
		confirmNewPage	: 'Any unsaved changes to this content will be lost. Are you sure you want to load new page?', // MISSING
		confirmCancel	: 'Some of the options have been changed. Are you sure to close the dialog?', // MISSING
		options			: 'Options', // MISSING
		target			: 'Target', // MISSING
		targetNew		: 'New Window (_blank)', // MISSING
		targetTop		: 'Topmost Window (_top)', // MISSING
		targetSelf		: 'Same Window (_self)', // MISSING
		targetParent	: 'Parent Window (_parent)', // MISSING

		// Put the voice-only part of the label in the span.
		unavailable		: '%1<span class="cke_accessibility">, unavailable</span>' // MISSING
	},

	contextmenu :
	{
		options : 'Context Menu Options' // MISSING
	},

	// Special char dialog.
	specialChar		:
	{
		toolbar		: 'વિશિષ્ટ અક્ષર ઇન્સર્ટ/દાખલ કરવું',
		title		: 'સ્પેશિઅલ વિશિષ્ટ અક્ષર પસંદ કરો',
		options : 'Special Character Options' // MISSING
	},

	// Link dialog.
	link :
	{
		toolbar		: 'લિંક ઇન્સર્ટ/દાખલ કરવી',
		other 		: '<other>', // MISSING
		menu		: ' લિંક એડિટ/માં ફેરફાર કરવો',
		title		: 'લિંક',
		info		: 'લિંક ઇન્ફૉ ટૅબ',
		target		: 'ટાર્ગેટ/લક્ષ્ય',
		upload		: 'અપલોડ',
		advanced	: 'અડ્વાન્સડ',
		type		: 'લિંક પ્રકાર',
		toUrl		: 'URL', // MISSING
		toAnchor	: 'આ પેજનો ઍંકર',
		toEmail		: 'ઈ-મેલ',
		targetFrame		: '<ફ્રેમ>',
		targetPopup		: '<પૉપ-અપ વિન્ડો>',
		targetFrameName	: 'ટાર્ગેટ ફ્રેમ નું નામ',
		targetPopupName	: 'પૉપ-અપ વિન્ડો નું નામ',
		popupFeatures	: 'પૉપ-અપ વિન્ડો ફીચરસૅ',
		popupResizable	: 'Resizable', // MISSING
		popupStatusBar	: 'સ્ટૅટસ બાર',
		popupLocationBar: 'લોકેશન બાર',
		popupToolbar	: 'ટૂલ બાર',
		popupMenuBar	: 'મેન્યૂ બાર',
		popupFullScreen	: 'ફુલ સ્ક્રીન (IE)',
		popupScrollBars	: 'સ્ક્રોલ બાર',
		popupDependent	: 'ડિપેન્ડન્ટ (Netscape)',
		popupWidth		: 'પહોળાઈ',
		popupLeft		: 'ડાબી બાજુ',
		popupHeight		: 'ઊંચાઈ',
		popupTop		: 'જમણી બાજુ',
		id				: 'Id', // MISSING
		langDir			: 'ભાષા લેખવાની પદ્ધતિ',
		langDirLTR		: 'ડાબે થી જમણે (LTR)',
		langDirRTL		: 'જમણે થી ડાબે (RTL)',
		acccessKey		: 'ઍક્સેસ કી',
		name			: 'નામ',
		langCode		: 'ભાષા લેખવાની પદ્ધતિ',
		tabIndex		: 'ટૅબ ઇન્ડેક્સ',
		advisoryTitle	: 'મુખ્ય મથાળું',
		advisoryContentType	: 'મુખ્ય કન્ટેન્ટ પ્રકાર',
		cssClasses		: 'સ્ટાઇલ-શીટ ક્લાસ',
		charset			: 'લિંક રિસૉર્સ કૅરિક્ટર સેટ',
		styles			: 'સ્ટાઇલ',
		selectAnchor	: 'ઍંકર પસંદ કરો',
		anchorName		: 'ઍંકર નામથી પસંદ કરો',
		anchorId		: 'ઍંકર એલિમન્ટ Id થી પસંદ કરો',
		emailAddress	: 'ઈ-મેલ સરનામું',
		emailSubject	: 'ઈ-મેલ વિષય',
		emailBody		: 'સંદેશ',
		noAnchors		: '(ડૉક્યુમન્ટમાં ઍંકરની સંખ્યા)',
		noUrl			: 'લિંક  URL ટાઇપ કરો',
		noEmail			: 'ઈ-મેલ સરનામું ટાઇપ કરો'
	},

	// Anchor dialog
	anchor :
	{
		toolbar		: 'ઍંકર ઇન્સર્ટ/દાખલ કરવી',
		menu		: 'ઍંકરના ગુણ',
		title		: 'ઍંકર