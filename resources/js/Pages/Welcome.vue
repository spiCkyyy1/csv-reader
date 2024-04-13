<script setup>
import {Head} from '@inertiajs/vue3'
import {useForm} from '@inertiajs/vue3'
import {router} from '@inertiajs/vue3'

const form = useForm({
    csv: null,
})

function submit() {
    router.post('/upload-csv', {
        method: 'put',
        csv: form.csv
    })
}

const props = defineProps(['data'])

function titlesRegex() {
    return /\b(?:Mr|Mrs|Ms|Dr|Prof|Mister|and|or|&)\.?\b/gi;
}

function findTitle(str) {
    // Define a regular expression pattern to match titles
    let regex = /\b(Mr|Mrs|Ms|Dr|Prof|Mister)\b/gi;

    // Use the match method to find all occurrences of titles in the string
    let matches = str.match(regex);

    // If matches are found, return them, otherwise return an empty array
    return matches ? matches : [];
}

function findFirstNames(str) {
    // Define a regular expression pattern to match titles
    let titleRegex = titlesRegex();

    // Remove titles from the string
    let firstNameStr = str.replace(titleRegex, '').trim();

    // Split the remaining string into words
    let words = firstNameStr.split(/\s+/);

    let singleCharacterOrPeriodRegex = /^[A-Za-z]\.?$/;
    let singleAmpersandCharacter = /^&+$/;

    if (words.length === 1 || singleAmpersandCharacter.test(words[0]) || singleCharacterOrPeriodRegex.test(words[0])) {
        return null;
    }
    if (words.length === 4) {
        return words[0] + ", " + words[2];
    }
    return words[0];
}

function findInitials(str) {
    // Define a regular expression pattern to match titles
    var titleRegex = titlesRegex();

    // Remove titles from the string
    var strWithoutTitles = str.replace(titleRegex, '').trim();

    // Split the string into words
    var words = strWithoutTitles.split(/\s+/);

    //Define a regular expression pattern to match single character or string containing period
    var regex = /^[A-Za-z]\.?$/;

    if (regex.test(words[0])) {
        return words[0];
    }
    return null;
}
</script>

<template>
    <Head title="Welcome"/>
    <h1>Csv Reader</h1>
    <form @submit.prevent="submit">
        <input type="file" @input="form.csv = $event.target.files[0]"/>
        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
            {{ form.progress.percentage }}%
        </progress>
        <button type="submit">Submit</button>
    </form>
    <span>Please upload the csv file.</span>
    <table class="table" v-if="props.data.length">
        <thead>
        <tr>
            <th scope="col">Full Name</th>
            <th>Title</th>
            <th>Initial</th>
            <th>First Name</th>
            <th>Last Name</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(owner, index) in props.data" :key="index">
            <td>{{ owner }}</td>
            <td>{{ findTitle(owner).join(", ") }}</td>
            <td>{{ findInitials(owner) }}</td>
            <td>{{ findFirstNames(owner) }}</td>
            <td>{{ owner.split(' ').slice(-1).join(' ') }}</td>
        </tr>
        </tbody>
    </table>
</template>
