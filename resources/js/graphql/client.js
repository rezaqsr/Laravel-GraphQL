import { GraphQLClient } from 'graphql-request';

function getCsrf() {
    const el = document.querySelector('meta[name="csrf-token"]');
    return el ? el.getAttribute('content') : '';
}

const client = new GraphQLClient('http://127.0.0.1:8000/graphql', {
    headers: {
        'X-CSRF-TOKEN': getCsrf(),
        'Content-Type': 'application/json',
    },
});

function parseGraphQLError(err) {
    const errs = err.response?.errors;
    if (!errs || !errs.length) return { general: [err.message] };

    const first = errs[0];

    if (first.extensions?.validation) {
        return first.extensions.validation;
    }

    try {
        const parsed = JSON.parse(first.message);
        if (parsed.errors) return parsed.errors;
    } catch (e) { /* ignore */ }

    return { general: [first.message] };
}

export { client, parseGraphQLError };
