import { SVG, Path, G } from '@wordpress/components';

export const SpeakerListIcon = ( { width = 24, height = 24 } ) => {
	const scaleRatio = Math.min( width / 24, height / 24 );

	return (
		<SVG xmlns="http://www.w3.org/2000/svg" width={ width } height={ height } fill="none">
			<G transform={ `scale(${ scaleRatio })` }>
				<Path d="M2.375 6A2.625 2.625 0 0 1 5 3.375h14A2.625 2.625 0 0 1 21.625 6v10.5a2.125 2.125 0 0 1-2.125 2.125.625.625 0 1 1 0-1.25.875.875 0 0 0 .875-.875V6c0-.76-.616-1.375-1.375-1.375H5c-.76 0-1.375.616-1.375 1.375v10.5c0 .483.392.875.875.875a.625.625 0 1 1 0 1.25A2.125 2.125 0 0 1 2.375 16.5V6Z"/>
				<Path d="M10.365 9.517a3.07 3.07 0 1 1 3.41 5.107 3.07 3.07 0 0 1-3.41-5.107ZM14.605 16.417a5.483 5.483 0 0 1 1.784 1.194A5.483 5.483 0 0 1 18 21.5a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5 5.5 5.5 0 0 1 5.5-5.5h1c.722 0 1.438.141 2.105.417Z"/>
			</G>
		</SVG>
	);
};