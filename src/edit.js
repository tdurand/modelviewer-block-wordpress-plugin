import { useBlockProps, InspectorControls, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { PanelBody, Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { useState } from '@wordpress/element';

export default function Edit({ attributes, setAttributes }) {
	const blockProps = useBlockProps();
	const { fileUrl } = attributes;
	console.log(fileUrl);

	// Function to handle file selection
	const onSelectFile = (media) => {
		console.log('select file')
		setAttributes({ fileUrl: media.url });
	};

	return (
		<>
			<div {...blockProps} style={{ width: "100%", height: "300px" }}>
				{/* Block Content - Main Editor Area */}
				{!fileUrl &&
					<MediaUploadCheck>
						<MediaUpload
							onSelect={onSelectFile}
							allowedTypes={['model/gltf-binary']}
							render={({ open }) => (
								<Button onClick={open} variant="primary">
									{fileUrl ? __('Change File', 'text-domain') : __('Upload File', 'text-domain')}
								</Button>
							)}
						/>
					</MediaUploadCheck>
				}

				{/* MODEL DOES NOT DISPLAY MODEL VIEWER NOT AVAILABLE, because in IFRAME
					look into "enqueue_block_editor_assets" to load script in editor context ??

					Also see why not instant when clicking Upload file for file already uploaded
				*/}

				{fileUrl && (
					<model-viewer
						src={fileUrl}
						camera-controls
						auto-rotate
						loading="auto"
					></model-viewer>
				)}

				{/* Sidebar Settings - Inspector Controls */}
				<InspectorControls>
					<PanelBody title={__('File Upload Settings', 'text-domain')} initialOpen={true}>
						<MediaUploadCheck>
							<MediaUpload
								onSelect={onSelectFile}
								allowedTypes={['model/gltf-binary']}
								render={({ open }) => (
									<Button onClick={open} variant="primary">
										{fileUrl ? __('Change File', 'text-domain') : __('Upload File', 'text-domain')}
									</Button>
								)}
							/>
						</MediaUploadCheck>
						{fileUrl && (
							<p>
								{__('Uploaded File URL:', 'text-domain')} <a href={fileUrl} target="_blank" rel="noopener noreferrer">{fileUrl}</a>
							</p>
						)}
					</PanelBody>
				</InspectorControls>
			</div>
		</>
	);
}

export function save({ attributes }) {
	const { fileUrl } = attributes;

	return (
		<div>
			{fileUrl && (
				<model-viewer
					src={fileUrl}
					camera-controls
					auto-rotate
					loading="auto"
				></model-viewer>
			)}
		</div>
	);
}
