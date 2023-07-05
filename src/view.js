/**
 * WordPress dependencies
 */
import { store } from '@wordpress/interactivity';

store({
	selectors: {
		likes: {
			isLiked: ({ state, context: { comment } }) =>
				state.likes.likedComments.includes(comment.id),
		},
	},
	actions: {
		likes: {
			toggle: ({ state, context }) => {
				const index = state.likes.likedComments.findIndex(
					(post) => post === context.comment.id
				);
				if (index === -1)
					state.likes.likedComments.push(context.comment.id);
				else state.likes.likedComments.splice(index, 1);
			},
		},
	},
});
