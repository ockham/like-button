/**
 * WordPress dependencies
 */
import { store } from '@wordpress/interactivity';

store({
	selectors: {
		likes: {
			isLiked: ({ state, context }) => {
				if ( context?.comment?.id ) {
					return state.likes.likedComments.includes(context.comment.id)
				} else if ( context?.post?.id ) {
					return state.likes.likedPosts.includes(context.post.id)
				}
			}
		},
	},
	actions: {
		likes: {
			toggle: ({ state, context }) => {
				if ( context?.comment?.id ) {
					const index = state.likes.likedComments.findIndex(
						(post) => post === context.comment.id
					);
					if (index === -1)
						state.likes.likedComments.push(context.comment.id);
					else state.likes.likedComments.splice(index, 1);
				} else if ( context?.post?.id ) {
					const index = state.likes.likedPosts.findIndex(
						(post) => post === context.post.id
					);
					if (index === -1)
						state.likes.likedPosts.push(context.post.id);
					else state.likes.likedPosts.splice(index, 1);
				}
			},
		},
	},
});
