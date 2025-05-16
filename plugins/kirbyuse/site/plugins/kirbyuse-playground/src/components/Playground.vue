<template>
	<k-section class="k-kirbyuse-playground" label="Kirbyuse Playground">		
		<section>
			<h3>useContent</h3>

			<div>
				<h4>currentContent</h4>
				<k-code language="js">{{ currentContent }}</k-code>
			</div>

			<div>
				<h4>contentChanges</h4>
				<k-code language="js">{{ contentChanges }}</k-code>
			</div>

			<div>
				<h4>hasChanges</h4>
				<k-code language="js">{{ hasChanges }}</k-code>			
			</div>

			<div>
				<h4>update()</h4>
				<k-button variant="filled" @click="updateContent">Apply Update</k-button>
			</div>
		</section>

		<section>
			<h3>useDialog</h3>

			<div>
				<h4>openTextDialog()</h4>
				<k-button variant="filled" @click="openTextDialog('Are you sure?')">Open Dialog</k-button>
			</div>

			<div>
				<h4>openFieldsDialog()</h4>
				<k-button 
					variant="filled"
					@click="openFieldsDialog({
						fields: {
							email: {
								type: 'email',
								label: 'Email'
							}
						}
					})" 
				>
					Open Dialog
				</k-button>
			</div>
		</section>

		<section>
			<h3>usePanel</h3>

			<div>
				<h4>panel.notification.success()</h4>
				<k-button variant="filled" @click="panel.notification.success('Success!')">Success</k-button>
			</div>

		</section>
	</k-section>
</template>

<script setup>
import { useContent, useDialog, usePanel } from "kirbyuse";

// useContent
const { currentContent, contentChanges, hasChanges, update } = useContent();

// useDialog
const { openTextDialog, openFieldsDialog } = useDialog();

// usePanel
const panel = usePanel();

const updateContent = () => {
	update({
		text: "Updated text"
	});
};

</script>

<style>
.k-kirbyuse-playground h3 {
	color: var(--color-text-dimmed);
}
.k-kirbyuse-playground h4 {
	margin-bottom: var(--spacing-2);
	font-family: var(--font-mono);
}
.k-kirbyuse-playground section {
	border: 1px solid var(--color-border);
	padding: var(--spacing-6);
	border-radius: var(--rounded);
}
.k-kirbyuse-playground section + section {
	margin-top: var(--spacing-6);
}
.k-kirbyuse-playground section > div {
	margin-top: var(--spacing-6);
}

</style>