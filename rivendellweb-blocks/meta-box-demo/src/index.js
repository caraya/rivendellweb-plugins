/**
 * Registers a new block provided a unique name and an object defining its behavior.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
 */
import { registerBlockType } from '@wordpress/blocks';
import { TextControl } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { useEntityProp } from '@wordpress/core-data';
import { useBlockProps } from '@wordpress/block-editor';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * All files containing `style` keyword are bundled together. The code used
 * gets applied both to the front of your site and to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
 import './style.scss';

registerBlockType( 'rivendellweb/meta-block', {
    title: 'Meta Block',
    icon: 'smiley',
    category: 'text',

    edit( { setAttributes, attributes } ) {
        const blockProps = useBlockProps();
        const postType = useSelect(
            ( select ) => select( 'core/editor' ).getCurrentPostType(),
            []
        );
        const [ meta, setMeta ] = useEntityProp( 'postType', postType, 'meta' );
        const metaFieldValue = meta[ 'rivendellweb_meta_block_field' ];
        function updateMetaValue( newValue ) {
            setMeta( { ...meta, rivendellweb_meta_block_field: newValue } );
        }

        return (
            <div { ...blockProps }>
                <TextControl
                    label="Meta Block Field"
                    value={ metaFieldValue }
                    onChange={ updateMetaValue }
                />
            </div>
        );
    },

    // No information saved to the block
    // Data is saved to post meta via the hook
    save() {
        return null;
    },
} );
